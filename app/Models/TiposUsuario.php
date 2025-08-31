<?php
namespace App\Models;
use App\Controller;
use PDO;

class TiposUsuario {
	public static function listarTipoUsuario() {
	$pdo = (new \Core\Database())->connect();
	$sql = "SELECT tipo_usuario_id, tipo_usuario_nombre FROM tipo_usuario";
	return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }
}