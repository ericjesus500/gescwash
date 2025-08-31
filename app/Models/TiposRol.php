<?php
namespace App\Models;
use App\Controller;
use PDO;

class TiposRol {
	public static function listarTipoRol() {
	$pdo = (new \Core\Database())->connect();
	$sql = "SELECT rol_id, rol_nombre FROM rol_empleado";
	return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }
}