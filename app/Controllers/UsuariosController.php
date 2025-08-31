<?php
namespace App\Controllers;
	
	class UsuariosController {
		public function viewAdmin() {
			// Variables disponibles en la vista
			$contenido = '../app/views/usuarios/viewAdmin.php';
			require_once '../app/views/layout/layoutSistema.php';
		}
	}