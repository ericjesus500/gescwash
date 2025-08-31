<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Activar Sistema - GESCWASH</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Fonts + Material Icons -->
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
      max-width: 500px;
      margin: 60px auto;
      padding: 30px;
      background-color: #1E1E1E;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 255, 170, 0.1);
    }

    h2 {
      text-align: center;
      color: #00ffaf;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-top: 20px;
      font-weight: 500;
    }

    input {
      padding: 12px;
      border-radius: 6px;
      border: none;
      background-color: #2A2A2A;
      color: #ffffff;
      margin-top: 5px;
    }

    input:focus {
      outline: none;
      background-color: #333;
      border-bottom: 2px solid #00ffaf;
    }

    button {
      margin-top: 30px;
      padding: 15px;
      background-color: #00ffaf;
      border: none;
      color: #000;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background-color: #00d499;
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
        margin: 20px;
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h2><span class="material-icons">lock_open</span> Activar Sistema</h2>

    <form action="/activacion/validarLicencia" method="POST">
      <label>🔑 Ingresa tu clave de activación</label>
      <input type="text" name="clave_activacion" required placeholder="Ej: GESCWASH-XXXX-YYYY">

      <button type="submit">Validar Clave</button>
    </form>
  </div>

</body>
</html>
