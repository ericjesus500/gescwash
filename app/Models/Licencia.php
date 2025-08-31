<?php
namespace App\Models;

use PDO;
use Core\Database;

class Licencia
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    /**
     * Verifica si la clave ingresada (texto plano) coincide con alguna clave hash pendiente en la base de datos.
     * 
     * 📌 Lógica:
     * - Selecciona únicamente las claves con estado 'pendiente'.
     * - Recorre una a una (fetch en streaming, no carga todo en memoria).
     * - Verifica con password_verify().
     *
     * @param string $claveIngresada Clave legible ingresada por el usuario.
     * @return array|false Devuelve el registro completo si es válida, o false si no.
     */

    public function validarClave(string $claveIngresada)
    {
        $stmt = $this->db->prepare("SELECT * FROM claves_licencia WHERE clave_estado = 'pendiente'");
        $stmt->execute();

        // Evitamos fetchAll() para no sobrecargar memoria si hay muchas claves
        while ($clave = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($claveIngresada, $clave['clave_activacion'])) {
                return $clave; // Clave válida
            }
        }

        return false; // Ninguna coincide        
    }

    /**
     * Marca una clave como usada y registra la fecha de uso.
     *
     * @param int $id_clave ID de la clave en la base de datos.
     * @return bool True si la operación fue exitosa, false en caso contrario.
     */

    public function marcarClaveUsada(int $id_clave): bool
    {
        $stmt = $this->db->prepare("UPDATE claves_licencia SET clave_estado = 'usada', clave_fecha_uso = NOW() WHERE id = ?");
        return $stmt->execute([$id_clave]);
    }

     /**
     * Obtiene todos los datos de una clave por su ID.
     *
     * @param int $id ID de la clave.
     * @return array|false Registro de la clave o false si no existe.
     */

    public function obtenerDetalle(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM claves_licencia WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
