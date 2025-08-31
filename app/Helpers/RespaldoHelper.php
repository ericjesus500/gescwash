<?php
namespace App\Helpers;

class RespaldoHelper
{
    private const ALGORITMO = 'AES-256-CBC';
    private const IV_LENGTH = 16;

    /**
     * Genera un respaldo cifrado del admin fundador + clave de restauración
     *
     * @param array  $datos   Datos a respaldar (admin, licencia, sucursal...)
     * @param string $carpeta Carpeta donde guardar los archivos
     * @return array|false    Devuelve array con info del respaldo o false en error
     */
    public static function generarRespaldoAdmin(array $datos, string $carpeta = '../storage/')
    {
        if (!is_dir($carpeta)) {
            if (!mkdir($carpeta, 0755, true) && !is_dir($carpeta)) {
                return false;
            }
        }

        $archivoRespaldo = $carpeta . 'admin_backup.gesc';
        $archivoClave    = $carpeta . 'admin_backup_clave.txt';

        $claveRestauracion = bin2hex(random_bytes(16)); // 32 caracteres hex -> 16 bytes
        $contenidoJson     = json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        $iv = substr($claveRestauracion, 0, self::IV_LENGTH);

        $contenidoCifrado = openssl_encrypt(
            $contenidoJson,
            self::ALGORITMO,
            $claveRestauracion,
            0,
            $iv
        );

        if ($contenidoCifrado === false) {
            return false;
        }

        // Guardar respaldo (base64 para evitar problemas binarios)
        file_put_contents($archivoRespaldo, base64_encode($contenidoCifrado));
        // Guardar clave en archivo separado
        file_put_contents($archivoClave, $claveRestauracion);

        return [
            'respaldo_path' => realpath($archivoRespaldo),
            'clave_path'    => realpath($archivoClave),
            'clave'         => $claveRestauracion
        ];
    }

    /**
     * Restaura un respaldo previamente generado
     *
     * @param string $rutaGesc  Ruta del archivo de respaldo .gesc
     * @param string $rutaClave Ruta del archivo con la clave de restauración
     * @return array|null       Devuelve array con datos restaurados o null si falla
     */
    public static function restaurarRespaldo(
        string $rutaGesc = '../storage/admin_backup.gesc',
        string $rutaClave = '../storage/admin_backup_clave.txt'
    ) {
        if (!file_exists($rutaGesc) || !file_exists($rutaClave)) {
            return null;
        }

        $clave = trim(file_get_contents($rutaClave));
        $cifradoBase64 = file_get_contents($rutaGesc);

        $contenidoPlano = openssl_decrypt(
            base64_decode($cifradoBase64),
            self::ALGORITMO,
            $clave,
            0,
            substr($clave, 0, self::IV_LENGTH)
        );

        if ($contenidoPlano === false) {
            return null;
        }

        return json_decode($contenidoPlano, true);
    }

    /**
     * Devuelve los últimos respaldos encontrados
     *
     * @param string $directorio Carpeta a escanear
     * @param int    $cantidad   Cantidad máxima de respaldos
     * @return array              Lista de rutas absolutas
     */
    public static function ultimosRespaldos(string $directorio = '../storage/', int $cantidad = 5): array
    {
        if (!is_dir($directorio)) {
            return [];
        }

        $archivos = glob($directorio . 'admin_backup*.gesc');

        usort($archivos, static function ($a, $b) {
            return filemtime($b) <=> filemtime($a);
        });

        return array_slice(array_map('realpath', $archivos), 0, $cantidad);
    }
}
