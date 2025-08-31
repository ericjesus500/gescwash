<?php
namespace App\Models;

use Core\Database;

class Admin {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function crear($nombre, $correo, $password) {
        $stmt = $this->db->prepare("INSERT INTO admin (nombre, correo, password) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $correo, $password]);
    }
}
