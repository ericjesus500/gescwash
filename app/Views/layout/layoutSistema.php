<?php
//use App\Middlewares\AuthMiddleware;
//use App\Helpers\LayoutHelper;
  //var_dump($_SESSION);
  //echo SesionHelper::haySesion() ? 'SESION OK' : 'SESION FALLA';
?>

<!--LayoutSistema -->
<div class="row"><?php require_once 'header.php';?></div>
<div class="row">
  <div class="col-md-3 col-sm-12">
    <?php require_once 'sidebar.php'; ?>
  </div>
  <div class="col-md-9 col-sm-12">
    <div class="contenido-principal">
      <?php
        if (isset($contenido) && file_exists($contenido)) {
          require_once $contenido;
        } else {
          echo "<p>Vista no encontrada</p>";
        }
      ?>
    </div>
  </div>  
</div>

<!--FIN LayoutSistema -->