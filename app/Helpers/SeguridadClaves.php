<?php
namespace App\Helpers;

class SeguridadClaves {
  // 🔐 Devuelve un hash seguro con bcrypt
  public static function hashear($valorPlano) {
    return password_hash($valorPlano, PASSWORD_DEFAULT);
  }

  // 🔎 Verifica una clave ingresada contra su hash almacenado
  public static function verificar($claveIngresada, $hashAlmacenado) {
    return password_verify($claveIngresada, $hashAlmacenado);
  }
}
