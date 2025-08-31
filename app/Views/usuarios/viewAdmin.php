<?php 
  use App\Helpers\RenderSelect; 
  $dataSelectIdentificacion = RenderSelect::renderSelectTipoIdentificacionOscuro();
?>
<div class="container">
	<div class="content">
		<div class="content-header">
			<h1><span class="material-icons">person_add</span>Gestión de Administradores</h1>		
		</div>
		<div class="container-form-regadmin">
			<form action="/activacion/registrar_admin" method="POST">
				<input type="hidden" name="admin_id" />
				<div class="row">
					<!-- Columna izquierda -->
					<div class="col-md-12 col-lg-9">
						<div class="row g-3">
							<div class="col-12 col-md-6 col-lg-6 d-flex flex-column">
								<label for="admin_nombre_completo">👤 Nombre completo</label>
								<input type="text" id="admin_nombre_completo" name="admin_nombre_completo" required />
							</div>
							<div class="col-12 col-md-6 col-lg-6 d-flex flex-column">
								<label for="admin_usuario">👥 Usuario</label>
								<input type="text" id="admin_usuario" name="admin_usuario" required>
							</div>
							<div class="col-12 col-md-6 col-lg-6 d-flex flex-column">
								<label for="admin_fecha_nacimiento">📅 Fecha de nacimiento</label>
								<input type="date" id="admin_fecha_nacimiento" name="admin_fecha_nacimiento" required />
							</div>
							<div class="col-12 col-md-6 col-lg-6 d-flex flex-column">
								<label for="admin_password">🔐 Contraseña</label>
								<input type="password" id="admin_password" name="admin_password" required />
							</div>
							<div class="col-12 col-md-6 col-lg-6">
								<?php echo $dataSelectIdentificacion; ?>					
							</div>
							<div class="col-12 col-md-6 col-lg-6 d-flex flex-column">
								<label for="admin_valor_ident">🔎 N° de identificación</label>
								<input type="text" id="admin_valor_ident" name="admin_valor_ident" required />
							</div>							
						</div>
					</div>
					<!-- Columna derecha -->
					<div class="col-md-12 col-lg-3">
						<div class="row g-3">
							<div class="col-lg-12 col-md-6 d-flex flex-column">
								<label for="admin_email">📧 Email</label>
								<input type="email" id="admin_email" name="admin_email" required />
							</div>
							<div class="col-lg-12 col-md-6 d-flex flex-column">
								<label for="admin_telefono">📞 Teléfono fijo (opcional)</label>
								<input type="text" id="admin_telefono" name="admin_telefono">
							</div>
							<div class="col-lg-12 col-md-6 d-flex flex-column">
								<label for="admin_movil">📱 Móvil</label>
								<input type="text" id="admin_movil" name="admin_movil" required />
							</div>
							<div class="col-lg-12 col-md-6 d-flex flex-column">
								<label for="admin_sucursal">🏢 Sucursal</label>
								<input type="text" id="admin_sucursal" name="admin_sucursal" required />
							</div>
						</div>
					</div>
				</div>
				<div class="mt-4">
					<button type="submit">✅ Registrar y Activar</button>
				</div>
			</form>
		</div>
	</div>
</div>