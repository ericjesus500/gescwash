<?php
namespace App\Helpers;

class RespaldoHelper
{
    /**
     * 1. Genera un respaldo del admin fundador encriptado + clave de restauración
     */
    public static function generarRespaldoAdmin(array $datos, string $carpeta = '../storage/')
    {
        $archivoRespaldo = $carpeta . 'admin_backup.gesc';
        $archivoClave    = $carpeta . 'admin_backup_clave.txt';

        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0755, true);
        }

        $claveRestauracion = bin2hex(random_bytes(16)); // Clave única
        $contenido = json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        // Encriptar respaldo
        $contenidoCifrado = base64_encode(openssl_encrypt(
            $contenido,
            'AES-256-CBC',
            $claveRestauracion,
            0,
            substr($claveRestauracion, 0, 16)
        ));

        // Guardar archivo cifrado
        file_put_contents($archivoRespaldo, $contenidoCifrado);
        // Guardar clave en archivo separado
        file_put_contents($archivoClave, $claveRestauracion);

        return file_exists($archivoRespaldo);
    }

    /**
     * 2. Restaurar respaldo (reinstalación del sistema)
     */
    public static function restaurarRespaldo(string $rutaGesc = '../storage/admin_backup.gesc', string $rutaClave = '../storage/admin_backup_clave.txt')
    {
        if (!file_exists($rutaGesc) || !file_exists($rutaClave)) {
            return null;
        }

        $clave = trim(file_get_contents($rutaClave));
        $cifrado = file_get_contents($rutaGesc);

        $contenidoPlano = openssl_decrypt(
            base64_decode($cifrado),
            'AES-256-CBC',
            $clave,
            0,
            substr($clave, 0, 16)
        );

        return json_decode($contenidoPlano, true);
    }

    /**
     * 3. Obtener últimos respaldos (hasta 5 más recientes)
     */
    public static function ultimosRespaldos(string $directorio = '../storage/', int $cantidad = 5): array
    {
        if (!is_dir($directorio)) return [];

        $archivos = glob($directorio . 'admin_backup*.gesc');

        usort($archivos, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });

        return array_slice($archivos, 0, $cantidad);
    }
}
