<?php
include("../class/ccontrol.inc");

// --- 1. Input Initialization & Sanitization ---

$tempresa = $_POST["txtempresa"] ?? '';
$tusuario = $_POST["txtusuario"] ?? '';
$tclave = $_POST["txtclave"] ?? '';

// Sanitize username (removing characters that could be used for injection)
$invalid_user_chars = ["-", "'", ";", "*", "%", "[", "#", "/", "="];
$tusuario = str_replace($invalid_user_chars, "", $tusuario);

// Sanitize password
$invalid_pass_chars = ["/", "-", "'", ";", "="];
$tclave = str_replace($invalid_pass_chars, "", $tclave);

// Get connection parameters from GET (with defaults from ccontrol.inc)
$host = $_GET["thost"] ?? $thost ?? 'localhost';
$port = $_GET["tport"] ?? $tport ?? '5432';

$existdb = "N";
$initial_user = "invsia";
$initial_key = "0agi6s";

// --- 2. Initial Connection to Retrieve System Credentials ---

$conn_str = "host=$host port=$port password=$initial_key user=$initial_user dbname=$tempresa";
$conn = pg_connect($conn_str);

if (!$conn) {
  echo "OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS 1<br>";
} else {
  $sql = "SELECT campo038, campo039 FROM SIA000";
  $res = pg_query($conn, $sql);

  if ($res && $registro = pg_fetch_array($res, 0)) {
    $user = $registro["campo038"];
    $key = $registro["campo039"];
    $existdb = "S";
  }
  pg_close($conn);
}

// --- 3. Main Connection and Authentication ---

if ($existdb == "S") {
  $conn_str = "host=$host port=$port password=$key user=$user dbname=$tempresa";
  $conn = pg_connect($conn_str);
  // print_r($conn_str);
  // exit;

  if (!$conn || pg_last_error($conn)) {
    echo "OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS 2<br>";
  } else {
    $tgnomina = "";

    // First validation check
    $sql = "SELECT * FROM SIA001 WHERE campo101='$tusuario' AND campo102='$tclave'";
    $res = pg_query($conn, $sql);
    $filas = pg_num_rows($res);

    // Security function check (overwrites result and row count as in original logic)
    $sql = "SELECT busca_sia001('$tusuario', '$tclave');";
    $res = pg_query($conn, $sql);
    $filas = pg_num_rows($res);

    if ($res && $filas >= 1) {
      $registro = pg_fetch_array($res);
      $filas = $registro[0];
    }

    if ($filas == 0) {
      $existdb = "N";
    } else {
      // Authentication successful
      if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }

      $_SESSION["autentificado"] = "SI";
      $_SESSION["usuario"] = $user;
      $_SESSION["usr_password"] = $key;
      $_SESSION["user_sia"] = $tusuario;
      $_SESSION["bdatos"] = $tempresa;
      $_SESSION["gnom"] = $tgnomina;
      $existdb = "S";
    }

    pg_close($conn);

    // --- 4. Redirection ---

    if ($existdb == "S") {
      header("Location: menu.php");
      exit;
    } else {
      header("Location: index.php?errorusuario=si");
      exit;
    }
  }
}
?>