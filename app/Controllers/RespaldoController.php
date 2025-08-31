<?php
namespace Controllers;
use App\Helpers\RespaldoHelper;

class RespaldoController {
  
  public function descargarRespaldo() {
	 session_start();
	$zipPath = $_SESSION['descarga_zip'] ?? null;

	if ($zipPath && file_exists($zipPath)) {
	  require '../app/views/respaldos/respaldo_confirmacion.php';
	  unset($_SESSION['descarga_zip']);
	} else {
	  echo "<p style='color:red;'>❌ No se encontró el archivo ZIP.</p>";
	}
  }

  public function mostrarEstadoRespaldo() {
    echo "<h3>📦 Estado del respaldo fundacional</h3>";
    $rutaGesc = '../storage/admin_backup.gesc';
    $rutaTxt  = '../storage/admin_backup_clave.txt';

    echo "<ul>";
    echo "<li>Archivo cifrado: " . (file_exists($rutaGesc) ? '✅ presente' : '❌ ausente') . "</li>";
    echo "<li>Clave TXT: " . (file_exists($rutaTxt) ? '✅ presente' : '❌ ausente') . "</li>";
    echo "</ul>";
  }
  
  public function enviarEmail() {
    // 🔐 Iniciar sesión si no está activa
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }

    // 📦 Obtener la ruta del ZIP y datos del administrador
    $zipPath = $_POST['zip_path'] ?? $_SESSION['descarga_zip'] ?? null;
    $auth         = $_SESSION['Auth'] ?? [];
    $adminNombre  = $auth['nombre'] ?? 'Administrador';
    $adminEmail   = $_POST['email'] ?? $auth['email'] ?? null;

    // 🚫 Validación de existencia de archivo
    if (!$zipPath || !file_exists($zipPath)) {
      echo "<pre style='color:red;'>❌ No se encontró el archivo ZIP para enviar.</pre>";
      //echo print_r($auth);
      exit;
    }

    // 🚫 Validación de correo
    if (!$adminEmail) {
      echo "<pre style='color:red;'>❌ No se encontró el correo electrónico del administrador.</pre>";
      exit;
    }

    // 📦 Autocarga de dependencias
    $autoloadPath = dirname(__DIR__, 2) . '/vendor/autoload.php';

    if (!file_exists($autoloadPath)) {
      echo "<pre style='color:red;'>❌ No se encontró autoload.php en: {$autoloadPath}</pre>";
      exit;
    }

    require_once $autoloadPath;

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
      // 🔧 Configuración del servidor SMTP
      $mail->isSMTP();
      $mail->Host       = 'smtp.tuservidor.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'tu_correo@dominio.com';
      $mail->Password   = 'tu_password';
      $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      // 👤 Datos de remitente y destinatario
      $mail->setFrom('tu_correo@dominio.com', 'GESCWASH');
      $mail->addAddress($adminEmail, $adminNombre);

      // 📨 Contenido del correo
      $mail->isHTML(true);
      $mail->Subject = '📦 Respaldo fundacional del sistema GESCWASH';
      $mail->Body    = "
        <p>Hola <strong>{$adminNombre}</strong>,</p>
        <p>Adjunto te enviamos el archivo de respaldo fundacional que contiene:</p>
        <ul>
          <li>Archivo cifrado de configuración inicial</li>
          <li>Clave única de restauración</li>
        </ul>
        <p>Este archivo permitirá reinstalar el sistema en el futuro sin necesidad de la clave original.</p>
        <p><strong>Guárdalo en un lugar seguro.</strong></p>
        <p>— Equipo GESCWASH</p>
      ";

      // 📎 Adjuntar archivo ZIP
      $mail->addAttachment($zipPath, 'admin_respaldo.zip');

      // 📤 Enviar correo
      $mail->send();

      echo "<pre style='color:green;'>✅ El respaldo fue enviado correctamente a: {$adminEmail}</pre>";
      echo "<a href='/inicio/viewDashboard' style='
        display:inline-block;
        margin-top:20px;
        background-color:#2e86de;
        color:white;
        padding:10px 18px;
        border-radius:6px;
        text-decoration:none;
      '>🚀 Ir al Dashboard del Sistema</a>";

    } catch (Exception $e) {
      echo "<pre style='color:red;'>❌ Error al enviar el correo: {$mail->ErrorInfo}</pre>";
    }

    // 🧹 Limpieza opcional si no requieres persistencia
    unset($_SESSION['descarga_zip']);
  }
}
