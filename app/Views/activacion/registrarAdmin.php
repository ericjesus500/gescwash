<?php 
  use App\Helpers\RenderSelect; 
  $dataSelectIdentificacion = RenderSelect::renderSelectTipoIdentificacionOscuro();
?>
<div class="content-body">
  <div class="container-reg-admin">
    <h2><span class="material-icons">person_add</span> Registro del Administrador</h2>

    <form action="/activacion/registrar_admin" method="POST">

      <!-- Clave activación validada -->
      <input type="hidden" name="clave_activacion" value="<?= htmlspecialchars($clave_valida) ?>">

      <label for="admin_nombre_completo">👤 Nombre completo</label>
      <input type="text" id="admin_nombre_completo" name="admin_nombre_completo" required>

      <label for="admin_usuario">👥 Usuario</label>
      <input type="text" id="admin_usuario" name="admin_usuario" required>

      <label for="admin_fecha_nacimiento">📅 Fecha de nacimiento</label>
      <input type="date" id="admin_fecha_nacimiento" name="admin_fecha_nacimiento" required>
      
      <?php echo $dataSelectIdentificacion; ?>

      <label for="admin_valor_ident">🔎 N° de identificación</label>
      <input type="text" id="admin_valor_ident" name="admin_valor_ident" required>

      <label for="admin_email">📧 Email</label>
      <input type="email" id="admin_email" name="admin_email" required>

      <label for="admin_telefono">📞 Teléfono fijo (opcional)</label>
      <input type="text" id="admin_telefono" name="admin_telefono">

      <label for="admin_movil">📱 Móvil</label>
      <input type="text" id="admin_movil" name="admin_movil" required>

      <label for="admin_sucursal">🏢 Nombre de la sucursal</label>
      <input type="text" id="admin_sucursal" name="admin_sucursal" required>

      <label for="admin_password">🔐 Contraseña</label>
      <input type="password" id="admin_password" name="admin_password" required>

      <button type="submit">✅ Registrar y Activar</button>
    </form>
  </div>
</div>