<?php
/*$zipPath = '../storage/admin_respaldo.zip';
$zipDisponible = file_exists($zipPath);
$peso = $zipDisponible ? round(filesize($zipPath) / 1024, 2) : null;
$ubicacion = $zipDisponible ? realpath($zipPath) : null;
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

// Seguridad: Evitar acceso directo
if (!isset($info) || !isset($_SESSION['Auth'])) {
    header('Location: /activacion/activarSistema');
    exit;
}*/

// Datos del admin fundador
/*$admin  = $_SESSION['Auth'];
$nombre = htmlspecialchars($admin['nombre']);
$rol    = htmlspecialchars($admin['rol']);
$correo = htmlspecialchars($admin['correo']);*/

// Datos del respaldo
/*$rutaRespaldo = isset($info['archivo']) ? $info['archivo'] : '../storage/admin_backup.gesc';
$rutaClave    = isset($info['clave']) ? $info['clave'] : '../storage/admin_backup_clave.txt';
$fecha        = date('d/m/Y H:i:s', filemtime($rutaRespaldo));*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Respaldo generado correctamente</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  -->

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #121212;
      color: #ffffff;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 60px auto;
      padding: 30px;
      background-color: #1e1e1e;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 0 20px rgba(0, 255, 170, 0.1);
    }
    
    h2 {
      color: #00ffaf; 
    }

    p {
      margin-top: 20px;
      font-size: 1.1em;
    }

    button {
      padding: 12px 25px;
      margin: 20px 10px 0;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn-primary {
      background-color: #00ffaf;
      color: #000;
    }

    .btn-secondary {
      background-color: #2a2a2a;
      color: #00ffaf;
      border: 1px solid #00ffaf;
    }

    button:hover {
      opacity: 0.9;
    }
    
    
    /* Estilos mvc-copilot */
    
    /*body {
      background-color: #121212;
      color: #e0e0e0;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 40px;
      text-align: center;
    }

    h2 {
      color: #2196F3;
      margin-top: 20px;
    }

    p {
      font-size: 17px;
      margin-top: 15px;
      color: #cccccc;
    }*/

    .btn-container {
      margin-top: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
    }

    a.button, button {
      background-color: #2e86de;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      text-decoration: none;
      width: 280px;
      transition: background-color 0.3s ease;
    }

    a.button:hover, button:hover {
      background-color: #1b4f72;
    }
    
    /* Estilos Nuevos */
    
    h1 {
      color: #2c3e50;
      text-align: center;
    }    
    .success {
        background: #e8f9f1;
        border: 1px solid #2ecc71;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        color: #27ae60;
        font-weight: bold;
        text-align: center;
    }
    .section {
        margin-bottom: 20px;
    }
    .label {
        font-weight: bold;
    }
    code {
        background: #f1f1f1;
        padding: 4px 6px;
        border-radius: 4px;
        font-size: 0.9em;
    }
    .btn {
        display: inline-block;
        background: #2ecc71;
        color: white;
        padding: 10px 18px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        text-align: center;
    }
    .btn:hover {
        background: #27ae60;
    }
	
	/*Clases de Google */
    /* fallback */
    @font-face {
      font-family: 'Material Icons';
      font-style: normal;
      font-weight: 400;
      src: url(/css/fonts/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
    }

    .material-icons {
      font-family: 'Material Icons';
      font-weight: normal;
      font-style: normal;
      font-size: 24px;
      line-height: 1;
      letter-spacing: normal;
      text-transform: none;
      display: inline-block;
      white-space: nowrap;
      word-wrap: normal;
      direction: ltr;
      -webkit-font-feature-settings: 'liga';
      -webkit-font-smoothing: antialiased;
    }

    @media (max-width: 600px) {
      .container {
        margin: 30px 20px;
        padding: 20px;
      }

      button {
        width: 100%;
        margin-top: 15px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>✅ Instalación completada</h1>
    
    <h2><span class="material-icons">backup</span> Respaldo creado exitosamente</h2>

    <div class="success">
        El sistema ha sido activado correctamente y el respaldo inicial fue creado.
    </div>

    <p><strong>Recuerda:</strong> Seguidamente dirígete al módulo <em>Usuarios</em> donde se te generará tu clave especial.</p>
    
    <div class="section">
        <p class="label">Administrador fundador:</p>
        <p>👤 <strong><?php //echo $nombre; ?></strong></p>
        <p>📌 Rol: <?php //echo $rol; ?></p>
        <p>✉️ Correo: <?php //echo $correo; ?></p>
    </div>

    <div class="section">
        <p class="label">Respaldo generado:</p>
        <p>📄 Archivo: <code><?php //echo basename($rutaRespaldo) ?></code></p>
        <p>⚖Tamaño: <strong><?php //echo $peso ?> KB</strong></p>
        <p>🔑 Clave de restauración guardada en: <code><?php //echo basename($rutaClave); ?></code></p>
        <p>Ubicación: <code><?php //echo $ubicacion ?></code></p>
        <p>📅 Fecha: <?php //echo $fecha ?></p>
    </div>
    
    <p style="font-size:18px; color:darkslategray;">
        Este archivo te permite reinstalar el sistema en el futuro sin usar la clave original.<br>
        Contiene los datos cifrados del administrador fundador y la clave de restauración única.
    </p>
    
    <div class="btn-container">
      <a href="<?php //echo $zipPath ?>" download class="button">📦 Descargar Respaldo ZIP</a>
      <p style="color:#cccccc; font-size:15px;">
        💡 También puedes enviar el respaldo fundacional por correo, desde el panel de configuración del sistema.
      </p>
    </div>

    <form method="POST" action="/respaldo/enviarEmail">
      <input type="hidden" name="archivo" value="admin_backup.gesc">
      <button type="submit" class="btn-primary">📤 Enviar respaldo al correo</button>
    </form>

    <form method="GET" action="home/dashboard">
      <button type="submit" class="btn-secondary">🏁 Ir al Dashboard</button>
    </form>
  </div>

</body>
</html>
