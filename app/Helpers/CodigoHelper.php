<?php
namespace App\Helpers;

class CodigoHelper
{
    /**
     * Genera un código especial a partir del nombre del admin y su sucursal
     * Formato sugerido: ABC-LIM-0825 (Iniciales + Sucursal + Fecha)
     */
    public static function generarCodigoEspecial(string $nombre_completo, string $sucursal): string
    {
        // 1. Obtener iniciales del nombre
        $nombre = strtoupper($nombre_completo);
        preg_match_all('/\b\w/', $nombre, $iniciales);
        $codigoNombre = implode('', array_slice($iniciales[0], 0, 3)); // Ej: "JLD"

        // 2. Obtener 3 letras de la sucursal (sin espacios)
        $sucursal = strtoupper(str_replace(' ', '', $sucursal));
        $codigoSucursal = substr($sucursal, 0, 3); // Ej: "LIM"

        // 3. Sufijo de mes y año actual
        $fecha = date('my'); // Ej: "0825"

        // 4. Unir todo
        return "{$codigoNombre}-{$codigoSucursal}-{$fecha}";
    }
}
