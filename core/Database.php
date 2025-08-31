<?php
namespace Core;

use PDO;
use PDOException;

class Database {
    private $host = '127.0.0.1';
	private static $puerto = '3306';
    private $db = 'gescwash';
    private $user = 'admin';
    private $pass = 'admin';
    private $charset = 'utf8mb4';
	//private static $pdo = null;

    public function connect() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
            return new PDO($dsn, $this->user, $this->pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                //PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                //PDO::ATTR_EMULATE_PREPARES => false
            ]);
        } catch (PDOException $e) {
            die("🔒 Error al conectar a la base de datos: " . $e->getMessage());
        }
    }
}