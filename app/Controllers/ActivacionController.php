<?php
namespace App\Controllers;

use Core\Controller;
use App\Helpers\SeguridadClaves;
use App\Helpers\CodigoHelper;
use App\Helpers\SeederHelper;
//use App\Helpers\RespaldoHelper;

class ActivacionController extends Controller {
    public function activarSistema() {
        $db = (new \Core\Database())->connect();

        $stmt = $db->query("SELECT COUNT(*) AS total FROM admin_sistema");
        $row = $stmt->fetch();

        if ($row['total'] > 0) {            
            $login = new \App\Controllers\LoginController();
            $login->login(); 
        } else {
            $this->ingresarClave(); 
        }
    }
    
    public function ingresarClave() {
        require_once '../app/views/activacion/viewIngresarClave.php';
    }
    
    public function validarLicencia() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asegurar sesión
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }

            $claveIngresada = trim($_POST['clave_activacion'] ?? '');
            if (empty($claveIngresada)) {
                // Mensaje simple y volver al inicio de activación
                echo "❌ Debes introducir una clave de activación. <a href='/activacion/activarSistema'>Volver</a>";
                return;
            }
            
            try {
                // Uso del modelo Licencia (debe devolver el registro si es válida, o false)
                $licenciaModel = new \App\Models\Licencia();
                $claveData = $licenciaModel->validarClave($claveIngresada); // ya hace password_verify internamente
                if (!$claveData) {
                    // No válida → informar y redirigir al flujo de inicio
                    echo "<div style='padding:20px; color:#ff7b7b; font-family:Arial, sans-serif;'>
                            ❌ Clave inválida o ya usada.
                            <br><br>
                            <a href='/activacion/activarSistema' style='color:#00ffaf;'>Intentar otra clave</a>
                          </div>";
                    return;
                }
                    
                // ✅ Clave válida — medidas de seguridad: regenerar id de sesión
                session_regenerate_id(true);

                // Guardar datos de la licencia en sesión
                $_SESSION['licencia_valida']   = true;
                $_SESSION['clave_activacion']  = $claveIngresada;   // texto legible que ingresó el usuario
                $_SESSION['datos_licencia']    = $claveData;     // array con los campos de la fila (id, sucursal, etc.)
                
                // Marcar como usada inmediatamente
                $licenciaModel->marcarClaveUsada((int)$claveData['id']);
                
                // Preparar variable para la vista (clave por seguridad escapada)
                $clave_valida = htmlspecialchars($claveIngresada, ENT_QUOTES, 'UTF-8');

                // Mostrar formulario de registro del admin (usa la clave oculta)
                require_once __DIR__ . '/../Views/activacion/registrarAdmin.php';

            } catch (\Throwable $e) {
                // Error inesperado
                error_log("validar Licencia error: " . $e->getMessage());
                echo "❌ Ocurrió un error al validar la clave. Intenta de nuevo más tarde.";
                return;
            }        
        } else {
          header('Location: /activacion/ingresarClave');
          exit;
        }
    }
    
    public function registrarAdmin() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $db = (new \Core\Database())->connect();
            
            // 1 Verificar que haya licencia válida en sesión
            if (empty($_SESSION['licencia_valida']) || $_SESSION['licencia_valida'] !== true) {
                header('Location: /activacion/activarSistema');
                exit;
            }

            // 2️ Verificar que la clave venga por POST y coincida con la de sesión
            $clave_post = trim($_POST['clave_activacion'] ?? '');
            if ($clave_post !== $_SESSION['clave_activacion']) {
                echo "❌ Clave no coincide con la sesión. <a href='/activacion/activarSistema'>Volver</a>";
                return;
            }
            
            // ✅ Semillas necesarias para tablas base
            SeederHelper::poblarSiNecesario($db);

            // 1. Obtener datos del formulario
            $nombre_completo      = trim($_POST['admin_nombre_completo']);
            $usuario              = trim($_POST['admin_usuario']);
            $fecha_nac            = $_POST['admin_fecha_nacimiento'];
            $tipo_ident_id        = intval($_POST['admin_tipo_ident_id']);            
            $valor_ident          = trim($_POST['admin_valor_ident']);
            $email                = trim($_POST['admin_email']);
            $telefono             = trim($_POST['admin_telefono']);
            $movil                = trim($_POST['admin_movil']);
            $sucursal_nombre      = trim($_POST['admin_sucursal']);
            $password_plano       = $_POST['admin_password'];
            $password_hash        = SeguridadClaves::hashear($password_plano);
            
            if (!$nombre_completo || !$usuario || !$fecha_nac || !$tipo_ident_id || !$valor_ident || !$email || !$movil || !$sucursal_nombre || empty($_POST['admin_password'])) {
                echo "⚠️ Faltan campos obligatorios. <a href='/activacion/registrarAdmin'>Volver</a>";
                return;
            }
            
            // OBTENER nombre del tipo desde BD
            $stmtTipo = $pdo->prepare("SELECT tipo_ident_nombre FROM tipo_identificacion WHERE tipo_ident_id = :id");
            $stmtTipo->execute(['id' => $tipo_ident_id]);
            $tipo_ident_nombre = $stmtTipo->fetchColumn();

            $codigo_especial = \App\Helpers\CodigoHelper::generarCodigoEspecial($nombre_completo, $sucursal_nombre);

            try {
                $db->beginTransaction();

                // 2. Insertar tipo de identificación
                $stmt = $db->prepare("INSERT INTO tipo_identificacion (tipo_ident_id, tipo_ident_nombre, tipo_ident_abreviatura) VALUES (?, ?, ?)");
                $stmt->execute([
                    $tipo_ident_id,
                    $tipo_ident_nombre,
                    strtoupper(substr($tipo_ident_nombre, 0, 4))
                ]);

                // 3. Insertar sucursal manualmente como primer registro
                $stmt = $db->prepare("INSERT INTO sucursal (sucursal_id, sucursal_nombre) VALUES (1, ?)");
                $stmt->execute([$sucursal_nombre]);
                $sucursal_id = 1;

                // 4. Insertar en admin_sistema
                $stmt = $db->prepare("INSERT INTO admin_sistema (
                    admin_nombre_completo, admin_usuario, admin_fecha_nacimiento,
                    admin_password, admin_tipo_ident_id, admin_tipo_ident_nombre,
                    admin_valor_ident, admin_codigo_especial,
                    admin_email, admin_telefono, admin_movil, admin_sucursal
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->execute([
                    $nombre_completo, $usuario, $fecha_nac,
                    $password_hash, $tipo_ident_id, $tipo_ident_nombre,
                    $valor_ident, $codigo_especial,
                    $email, $telefono, $movil, $sucursal_nombre
                ]);

                // 5. Insertar también como usuario fundador
                $stmt = $db->prepare("INSERT INTO usuarios (
                    usuario_tipo_id, usuario_tipo_identificacion, usuario_documento,
                    usuario_nombre_completo, usuario_direccion, usuario,
                    usuario_fecha_ingreso, usuario_rol_id, usuario_email,
                    usuario_telefono, usuario_movil, usuario_fecha_nacimiento,
                    usuario_estado, usuario_password, usuario_codigo_especial,
                    usuario_sucursal_id, usuario_password_plana
                ) VALUES (?, ?, ?, ?, '', ?, CURDATE(), ?, ?, ?, ?, ?, 1, ?, ?, ?, ?)");

                $stmt->execute([
                    1, // tipo usuario: empleado
                    $tipo_ident_id, $valor_ident,
                    $nombre_completo, $usuario,
                    7, // rol_id fundador
                    $email, $telefono, $movil, $fecha_nac,
                    $password_hash, $codigo_especial,
                    $sucursal_id, $password_plano
                ]);
                
                // 6. Obtener los datos de Rol
                
                // 6.1 Capturamos el ID generado
                $idUsuario = $pdo->lastInsertId(); 

                // 6.2 Obtener el usuario_rol_id del usuario insertado      
                $stmtUserData = $pdo->prepare("
                SELECT usuario_rol_id FROM usuario WHERE usuario_id = :id
                ");
                $stmtUserData->execute(['id' => $idUsuario]);
                $usuarioData = $stmtUserData->fetch(PDO::FETCH_ASSOC);
                $rolId = $usuarioData['usuario_rol_id'] ?? 7;

                // 6.3 Obtener el nombre del rol desde roles_empleado
                $stmtRol = $pdo->prepare("
                SELECT rol_nombre FROM rol_empleado WHERE rol_id = :rol_id
                ");
                $stmtRol->execute(['rol_id' => $rolId]);
                $rolNombre = $stmtRol->fetchColumn() ?? 'Admin. Activador de Software';               

                $db->commit();
                
                // 7. Guardar variables de sesión para Auth y licencia
                $_SESSION['Auth'] = [
                    'admin_nombre'    => $nombre_completo,
                    'admin_usuario'   => $usuario,
                    'admin_email'     => $email,
                    'admin_rol'       => $rolNombre,
                    'admin_sucursal'  => $sucursal_nombre,
                    'codigo_especial' => $codigo_especial
                ];

                // 8. Crear respaldo automático
                $respaldoDatos = [
                    'admin' => [
                        'nombre_completo' => $nombre_completo,
                        'usuario'         => $usuario,
                        'codigo_especial' => $codigo_especial,
                        'sucursal'        => $sucursal_nombre,
                        'rol_id'          => $rolId,
                        'email'           => $email,
                        'telefono'        => $telefono,
                        'movil'           => $movil,
                        'tipo_id'         => $tipo_ident_id,
                        'identificacion'  => $tipo_ident_nombre . ": " . $valor_ident,
                        'fecha_nacimiento'   => $fec_nac,
                        'fecha'           => date('Y-m-d H:i:s')                        
                    ],
                    'clave_activacion' => $clave_input,
                    'timestamp'        => date('Y-m-d H:i:s'),
                ];

                $zipPath = \App\Helpers\RespaldoHelper::generarRespaldoAdmin($respaldoDatos);
                
                // 8.1 Comprobar que se guardo el archivo de respaldo
                if (!file_exists($zipPath)) {
                    // Manejo de error: puedes lanzar excepción, redireccionar, o mostrar mensaje
                    throw new Exception("No se pudo generar el respaldo ZIP.");
                }

                $_SESSION['descarga_zip'] = $zipPath;

                // 9.Limpiar las sesiones temporales
                unset($_SESSION['licencia_valida'], $_SESSION['clave_activacion'], $_SESSION['datos_licencia']);

                // 10. Redirigir a vista respaldo_confirmacion por medio de su controlador
                header('Location: /respaldo/descargarRespaldo');
                exit;
                
            } catch (\Exception $e) {
                $db->rollBack();
                echo "❌ Error al registrar: " . $e->getMessage();
            }
        }
    }
}
