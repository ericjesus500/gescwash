<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #e0e0e0;
        }

        .login-container {
            background: rgba(30, 30, 46, 0.8);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 480px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h1 {
            color: #4cc9f0;
            font-size: 28px;
            margin-bottom: 12px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .login-header p {
            color: #a9b1d2;
            font-size: 16px;
            opacity: 0.9;
        }

        .form-group {
            position: relative;
            margin-bottom: 30px;
        }

        .floating-label {
            position: absolute;
            left: 16px;
            top: 16px;
            color: #a9b1d2;
            font-size: 16px;
            font-weight: 400;
            pointer-events: none;
            transition: all 0.3s ease;
            background: rgba(30, 30, 46, 0.8);
            padding: 0 4px;
        }
		
        .input-field {
            width: 100%;
            padding: 16px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            font-size: 16px;
            background: rgba(40, 40, 58, 0.5);
            color: #e0e0e0;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-field:focus {
            border-color: #4cc9f0;
            box-shadow: 0 0 0 3px rgba(76, 201, 240, 0.2);			
        }

        .input-field:focus ~ .floating-label,
        .input-field:not(:placeholder-shown) ~ .floating-label {
            top: -10px;
            left: 12px;
            font-size: 12px;
            color: #4cc9f0;
            font-weight: 500;
            background: rgba(30, 30, 46, 0.9);
            padding: 0 6px;
        }

        .validation-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .validation-icon.show {
            opacity: 1;
        }

        .validation-icon.success {
            color: #06d6a0;
        }

        .validation-icon.error {
            color: #ef476f;
        }

        .error-message {
            color: #ef476f;
            font-size: 14px;
            margin-top: 8px;
            margin-left: 16px;
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .error-message.show {
            display: block;
        }

        .example {
            background: rgba(40, 40, 58, 0.7);
            padding: 12px 16px;
            border-radius: 8px;
            margin-top: 15px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            color: #8ac9ff;
            border: 1px solid rgba(76, 201, 240, 0.3);
            border-left: 4px solid #4cc9f0;
        }

        .example-title {
            font-weight: 500;
            margin-bottom: 4px;
            color: #a9b1d2;
        }

        .login-button {
            width: 100%;
            background: linear-gradient(135deg, #4cc9f0 0%, #4361ee 100%);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(76, 201, 240, 0.3);
            margin-top: 10px;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(76, 201, 240, 0.4);
            background: linear-gradient(135deg, #3bc4ee 0%, #3a59d8 100%);
        }

        .login-button:disabled {
            background: #666;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            opacity: 0.6;
        }

        .form-footer {
            text-align: center;
            margin-top: 30px;
            color: #a9b1d2;
            font-size: 14px;
            opacity: 0.8;
        }

        .dark-mode-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(30, 30, 46, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dark-mode-toggle:hover {
            transform: rotate(30deg);
            background: rgba(40, 40, 58, 0.9);
        }

        .material-icons {
            font-size: 20px;
            color: #a9b1d2;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
                margin: 20px;
            }
            
            .login-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="dark-mode-toggle">
        <i class="material-icons">dark_mode</i>
    </div>

    <div class="login-container">
        <div class="login-header">
            <h1>Iniciar Sesión</h1>
            <p>Accede con tus credenciales de seguridad</p>
        </div>

        <form id="login-form" action="validarDatosAcceso.php" method="POST">
            <div class="form-group">
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="input-field" 
                    placeholder=" "
                    maxlength="30"
                >
                <label for="email" class="floating-label">Correo Electrónico</label>
                <div class="validation-icon" id="email-icon">
                    <i class="material-icons">check_circle</i>
                </div>
                <div id="email-error" class="error-message"></div>
            </div>

            <div class="form-group">
                <input 
                    type="text" 
                    id="codigo" 
                    name="codigo" 
                    class="input-field" 
                    placeholder=" "
                >
                <label for="codigo" class="floating-label">Código Especial</label>
                <div class="validation-icon" id="codigo-icon">
                    <i class="material-icons">check_circle</i>
                </div>
                <div id="codigo-error" class="error-message"></div>
                
                <div class="example">
                    <div class="example-title">Ejemplo: <span>EJCV-PIU-25072678</span></div>
                    
                </div>
            </div>

            <button type="submit" id="login-button" class="login-button">Iniciar Sesión</button>
        </form>

        <div class="form-footer">
            ¿Necesitas ayuda con tu acceso?
            <br>
            Contacta al equipo de soporte
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            const codigoInput = document.getElementById('codigo');
            const loginForm = document.getElementById('login-form');
            const loginButton = document.getElementById('login-button');
            
            const emailError = document.getElementById('email-error');
            const codigoError = document.getElementById('codigo-error');
            const emailIcon = document.getElementById('email-icon');
            const codigoIcon = document.getElementById('codigo-icon');

            // Expresión regular para el código: EJCV-PIU-25072678
            const codigoRegex = /^[A-Z]{4}-[A-Z]{3}-\d{8}$/;

            function validateEmail() {
                const email = emailInput.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (email === '') {
                    showError(emailError, 'El correo es requerido');
                    hideIcon(emailIcon);
                    emailInput.style.borderColor = '#ef476f';
                    return false;
                } else if (email.length > 30) {
                    showError(emailError, 'El correo no debe exceder los 30 caracteres');
                    hideIcon(emailIcon);
                    emailInput.style.borderColor = '#ef476f';
                    return false;
                } else if (!emailRegex.test(email)) {
                    showError(emailError, 'Formato de correo inválido');
                    hideIcon(emailIcon);
                    emailInput.style.borderColor = '#ef476f';
                    return false;
                } else {
                    hideError(emailError);
                    showIcon(emailIcon, 'success');
                    emailInput.style.borderColor = '#06d6a0';
                    return true;
                }
            }

            function validateCodigo() {
                const codigo = codigoInput.value.trim();
                
                if (codigo === '') {
                    showError(codigoError, 'El código es requerido');
                    hideIcon(codigoIcon);
                    codigoInput.style.borderColor = '#ef476f';
                    return false;
                } else if (!codigoRegex.test(codigo)) {
                    showError(codigoError, 'Formato de código inválido. Debe ser como: EJCV-PIU-25072678');
                    hideIcon(codigoIcon);
                    codigoInput.style.borderColor = '#ef476f';
                    return false;
                } else {
                    hideError(codigoError);
                    showIcon(codigoIcon, 'success');
                    codigoInput.style.borderColor = '#06d6a0';
                    return true;
                }
            }

            function showError(element, message) {
                element.textContent = message;
                element.classList.add('show');
            }

            function hideError(element) {
                element.classList.remove('show');
            }

            function showIcon(iconElement, type) {
                iconElement.classList.add('show');
                iconElement.classList.remove('error');
                iconElement.classList.add('success');
                iconElement.querySelector('.material-icons').textContent = 'check_circle';
            }

            function hideIcon(iconElement) {
                iconElement.classList.remove('show');
            }

            function validateForm() {
                const isEmailValid = validateEmail();
                const isCodigoValid = validateCodigo();
                return isEmailValid && isCodigoValid;
            }

            // Event listeners para validación en tiempo real
            emailInput.addEventListener('blur', validateEmail);
            emailInput.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    hideError(emailError);
                    hideIcon(emailIcon);
                    this.style.borderColor = 'rgba(255, 255, 255, 0.1)';
                } else {
                    validateEmail();
                }
            });

            codigoInput.addEventListener('blur', validateCodigo);
            codigoInput.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    hideError(codigoError);
                    hideIcon(codigoIcon);
                    this.style.borderColor = 'rgba(255, 255, 255, 0.1)';
                } else {
                    validateCodigo();
                }
            });

            // Validación antes de enviar el formulario
            loginForm.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
