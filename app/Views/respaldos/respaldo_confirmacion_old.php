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
    <h2><span class="material-icons">backup</span> Respaldo creado exitosamente</h2>

    <p>El archivo de respaldo fue generado correctamente y se ha almacenado de forma segura.</p>

    <p><strong>Recuerda:</strong> Seguidamente dirígete al módulo <em>Usuarios</em> donde se te generará tu clave especial.</p>

    <form method="POST" action="/respaldo/enviarEmail">
      <input type="hidden" name="archivo" value="admin_backup.gesc">
      <button type="submit" class="btn-primary">📤 Enviar respaldo al correo</button>
    </form>

    <form method="GET" action="/dashboard">
      <button type="submit" class="btn-secondary">🏁 Ir al Dashboard</button>
    </form>
  </div>

</body>
</html>
