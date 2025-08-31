<?php
namespace App\Controllers;

	class PruebasController {
		public function viewFormAdmin(){
			include_once "../app/views/activacion/registrarAdmin.php";
		}
		
		public function verLogin(){
			include_once "../app/views/login/viewLogin.php";
		}
		
		public function verIngresarClave(){
			include_once "../app/views/activacion/viewIngresarClave.php";
		}
		
		public function verRespaldo(){
			include_once "../app/views/respaldos/respaldo_confirmacion.php";
		}
		
		public function viewAdmin(){
			include_once "../app/views/usuarios/viewAdmins.php";
		}
	}