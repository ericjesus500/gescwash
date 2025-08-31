<?php
	require_once __DIR__ . '/../vendor/autoload.php';
	
	use Core\Router;
	
	// Detectar si es petición AJAX (JSON)
	$isAjax = (
		isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
	) || (
		isset($_SERVER['CONTENT_TYPE']) &&
		strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false
	);
	
	if ($isAjax) {
		// Solo ejecuta el router y termina
		$router = new Router();
		$router->dispatch(true);
		exit;
	}
	
	// Si no es AJAX, carga el layout completo
	include '../app/views/layout/head.php';
	?>
	<div class="container-fluid">
		<main class="main">
			<!-- Aquí se incluye el contenido específico -->
			<?php			
				// Carga dinámica del contenido central
				// Obtener la ruta desde el navegador
				$url = $_GET['url'] ?? '';
				if (isset($url)){
					$router = new Router($url);	
					$router->dispatch();
					//echo "La URL ES: " . htmlspecialchars($url);
				} else {
					echo "No existe URL";
				}
			?>
		</main>
	</div>
	<?php include '../app/views/layout/footer.php'; ?>

<?php
	// Obtener la ruta desde el navegador
	/*$url = $_GET['url'] ?? '';
	if (isset($url)){
		$router = new Router($url);	
		$router->dispatch();
		//echo "La URL ES: " . htmlspecialchars($url);
	} else {
		echo "No existe URL";
	}*/
?>