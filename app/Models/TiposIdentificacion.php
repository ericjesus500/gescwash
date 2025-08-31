<?php
namespace App\Models;
use Core\Controller;
use PDO;

class TiposIdentificacion {
	public static function listarTipoIdentificacion() {
	$pdo = (new \Core\Database())->connect();
	$sql = "SELECT tipo_ident_id, tipo_ident_nombre FROM tipo_identificacion";
	return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }
}