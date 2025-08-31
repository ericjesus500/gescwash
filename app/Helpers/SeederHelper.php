<?php
namespace App\Helpers;

class SeederHelper {
  public static function poblarSiNecesario(PDO $pdo) {
    // Tipos de identificación
    $countIdent = $pdo->query("SELECT COUNT(*) FROM tipo_identificacion")->fetchColumn();
    if ($countIdent == 0) {
      $pdo->exec("
        INSERT INTO tipo_identificacion (tipo_ident_id, tipo_ident_nombre, tipo_ident_abreviatura, tipo_ident_descripcion) VALUES
        (1, 'DNI', 'DNI', 'Documento Nacional de Identidad'), (2, 'RUC', 'RUC', 'Registro Unico de Contribuyente'), (3, 'PASAPORTE', 'PASSP', 'Identificador de ciudadania extranjera')
      ");
    }

    // Tipos de usuario
    $countTipoUser = $pdo->query("SELECT COUNT(*) FROM tipo_usuario")->fetchColumn();
    if ($countTipoUser == 0) {
      $pdo->exec("
        INSERT INTO tipo_usuario (tipo_usuario_id, tipo_usuario_nombre, tipo_usuario_descripcion) VALUES
        (1, 'Empleado', 'Empleado en Planilla'), (2, 'Cliente', 'Cliente Fijo'), (3, 'Proveedor', 'Proveedor Nacional'), (4, 'Transportista', 'Prestador de Servicio de Tansporte')
      ");
    }

    // Roles de empleado
    $countRoles = $pdo->query("SELECT COUNT(*) FROM rol_empleado")->fetchColumn();
    if ($countRoles == 0) {
      $pdo->exec("
        INSERT INTO roles_empleado (rol_id, rol_nombre, rol_descripcion) VALUES
        (1, 'Gerente General', 'Sin acceso a Configuraciones'),
        (2, 'Gerente Comercial', 'Acceso a Modulos de Gestion Comercial'),
        (3, 'Administrador', 'Accede a funciones Intermedias'),
        (4, 'Vendedor', 'Acceso a Modulos de Gestion Comercial'),
		(5, 'Cobrador', 'Acceso a Modulos de Gestion Comercial'),
		(6, 'Admin. de Software', 'Acceso total del Sistema'),
        (7, 'Admin. Activador de Software', 'Acceso total del Sistema')
      ");
    }
  }
  
  public static function verificarEstado(PDO $pdo) {
    $estado = [];

    $tablas = [
      'tipo_identificacion',
      'tipo_usuario',
      'rol_empleado'
    ];

    foreach ($tablas as $tabla) {
      $stmt = $pdo->query("SELECT COUNT(*) FROM $tabla");
      $total = $stmt->fetchColumn();
      $estado[$tabla] = ($total > 0) ? '✔️ poblada' : '❌ vacía';
    }

    return $estado;
  }
}
