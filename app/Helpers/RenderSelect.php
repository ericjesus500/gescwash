<?php
namespace App\Helpers;
use Core\Controller;
use App\Models\TiposUsuario;
use App\Models\TiposIdentificacion;
use App\Models\TiposRol;
use App\Models\Sucursal;
use PDO;

//Muestra los tipos de Identificacion en un Select
class RenderSelect {
  
  public static function renderSelectTipoIdentificacion($name = 'tipo_identificacion', $selected = '', $label = 'Tipo de identificación') {
    $pdo = (new \Core\Database())->connect();
    
    $tiposIdent = TiposIdentificacion::listarTipoIdentificacion();
    
    ob_start(); // Inicia el buffer de salida

    echo "<label for=\"{$name}\" class='form-label'>{$label}</label>";    
    echo "<select id=\"{$name}\" class='form-select' name=\"{$name}\" required>";
    echo '<option value="" disabled selected></option>';
    foreach ($tiposIdent as $tipo) {
      $id = $tipo['tipo_ident_id'];
      $nombre = htmlspecialchars($tipo['tipo_ident_nombre']);
      $isSelected = ($selected == $id) ? 'selected' : '';
      echo "<option value=\"{$id}\" {$isSelected}>{$nombre}</option>";
    }
    echo '</select>';
    
    return ob_get_clean(); // Devuelve el contenido del buffer como string
  }
  
  public static function renderSelectTipoIdentificacionOscuro($name = 'tipo_ident_id', $selected = '', $label = 'Tipo de identificación') {
    $pdo = (new \Core\Database())->connect();
    
    $tiposIdent = TiposIdentificacion::listarTipoIdentificacion();
    
    ob_start(); // Inicia el buffer de salida    
    
    //echo '<div class="input-group">';
    echo "<label for=\"{$name}\">🆔 {$label}</label>";
    echo '<span class="checkmark">✔</span>'; 
    echo "<select class='w-100' id=\"{$name}\" name=\"{$name}\" required>";
    echo '<option value="" disabled selected></option>'; 
    foreach ($tiposIdent as $tipo) {
        $id = $tipo['tipo_ident_id'];
        $nombre = htmlspecialchars($tipo['tipo_ident_nombre']);
        $isSelected = ($selected == $id) ? 'selected' : '';
        echo "<option value=\"{$id}\" {$isSelected}>{$nombre}</option>"; 
    }
    echo '</select>'; 
    //echo '</div>'; 
    
    return ob_get_clean(); // Devuelve el contenido del buffer como string
  }
  
  public static function renderSelectRol($name = 'rol_empleado', $selected = '', $label = 'Rol (si aplica)') {
    $pdo = (new \Core\Database())->connect();
    
    $roles = TiposRol::listarTipoRol();
    
    ob_start(); // Inicia el buffer de salida
    
    echo "<label for=\"{$name}\" class='form-label'>{$label}</label>";    
    echo "<select id=\"{$name}\" class='form-select' name=\"{$name}\" required>";
    echo '<option value="" disabled selected>-- Sin rol --</option>';
    foreach ($roles as $rol) {
      $id = $rol['rol_id'];
      $nombre = htmlspecialchars($rol['rol_nombre']);
      $isSelected = ($selected == $id) ? 'selected' : '';
      echo "<option value=\"{$id}\" {$isSelected}>{$nombre}</option>";
    }
    echo '</select>';    
    
    return ob_get_clean(); // Devuelve el contenido del buffer como string
  }
  
  public static function renderSelectTipoUsuario($name = 'tipo_usuario', $selected = '', $label = 'Tipo de Usuario') {
    $pdo = (new \Core\Database())->connect();
    
    $tipoUsuario = TiposUsuario::listarTipoUsuario();
    
    ob_start();
    
    echo "<label for=\"{$name}\" class='form-label'>{$label}</label>";    
    echo "<select id=\"{$name}\" class='form-select' name=\"{$name}\" required>";
    echo '<option value="" disabled selected>Seleccione Tipo</option>';
    foreach ($tipoUsuario as $tipo) {
      $id = $tipo['tipo_usuario_id'];
      $nombre = htmlspecialchars($tipo['tipo_usuario_nombre']);
      $isSelected = ($selected == $id) ? 'selected' : '';
      echo "<option value=\"{$id}\" {$isSelected}>{$nombre}</option>";
    }
    echo '</select>';    
    
    return ob_get_clean();
  }
  
  public static function renderSelectSucursal($name = 'sucursal', $selected = '', $label = 'Sucursal') {
    $pdo = (new \Core\Database())->connect();
    
    $sucursales = Sucursal::listarSucursales();
    
    ob_start();
    
    echo "<label for=\"{$name}\" class='form-label'>{$label}</label>";    
    echo "<select id=\"{$name}\" class='form-select' name=\"{$name}\" required>";
    echo '<option value="" disabled selected></option>';
    foreach ($sucursales as $sucursal) {
      $id = $sucursal['sucursal_id'];
      $nombre = htmlspecialchars($sucursal['sucursal_nombre']);
      $isSelected = ($selected == $id) ? 'selected' : '';
      echo "<option value=\"{$id}\" {$isSelected}>{$nombre}</option>";
    }
    echo '</select>';    
    
    return ob_get_clean();
  }
}
