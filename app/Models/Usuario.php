<?php
namespace App\Models;

use Core\Database;

class Usuario {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function crear($nombre, $correo, $password, $rol = 'admin') {
        $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, correo, password, rol) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $correo, $password, $rol]);
    }
}
