<?php //use App\Helpers\SesionHelper; ?>
<!--HEADER-->
<nav class="navbar navbar-expand-lg nav-header rounded-end">
  <div class="col-12 d-flex flex-row-reverse">
      <ul class="navbar-nav me-4">
        <?php //if (SesionHelper::haySesion()): ?>
        <li class="nav-item">
          <a class="nav-link logout-trigger" href="/logout">Cerrar sesión</a>
        </li>
      <?php //endif; ?>
      </ul>
  </div>
</nav>
<script>  
  //window.nombreUsuario = <?php //echo json_encode(SesionHelper::nombreCorto() ?? 'usuario') ?>;
  //window.rolUsuario = <?php //echo json_encode(SesionHelper::obtenerRolUsuario() ?? 'usuario') ?>;
  //console.log(nombreUsuario); //Para verificar que efectivamente existe
</script>
<!--FIN HEADER-->