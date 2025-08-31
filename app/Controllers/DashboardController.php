<?php
namespace App\Controllers;

	class DashboardController{
		public function viewDashboard() {
			$contenido = '../app/views/dashboard/viewDashboard.php';
			require_once '../app/views/layout/layoutSistema.php';
		}
}