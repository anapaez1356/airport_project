<?php
include 'db.php';

function registrarUsuario($usuario, $contrasena, $rol) {
  global $conn;
  $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);
  $sql = "INSERT INTO usuarios (usuario, contrasena, rol) VALUES ('$usuario', '$hashed_password', '$rol')";
  return $conn->query($sql);
}

function iniciarSesion($usuario, $contrasena) {
  global $conn;
  $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($contrasena, $row['contrasena'])) {
      return $row;
    }
  }
  return false;
}

function registrarAvion($datos) {
  global $conn;
  $sql = "INSERT INTO aviones (fecha, hora, matricula, equipo, comandante, licencia_comandante, sub_comandante, licencia_sub_comandante, num_pasajeros) VALUES ('{$datos['fecha']}', '{$datos['hora']}', '{$datos['matricula']}', '{$datos['equipo']}', '{$datos['comandante']}', '{$datos['licencia_comandante']}', '{$datos['sub_comandante']}', '{$datos['licencia_sub_comandante']}', '{$datos['num_pasajeros']}')";
  return $conn->query($sql);
}

function obtenerRegistros() {
  global $conn; // Asegúrate de tener una conexión a la base de datos

  $query = "SELECT * FROM aviones ORDER BY fecha DESC"; // Ajusta el nombre de la tabla si es diferente
  $resultado = mysqli_query($conn, $query);

  if (!$resultado) {
      return []; // Devuelve un array vacío si hay un error en la consulta
  }

  $registros = [];
  while ($fila = mysqli_fetch_assoc($resultado)) {
      $registros[] = $fila;
  }

  return $registros;
}

function obtenerAvionPorId($id) {
  global $conn;
  $id = mysqli_real_escape_string($conn, $id);
  $sql = "SELECT * FROM aviones WHERE id = '$id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  }
  return null;
}

function actualizarAvion($datos) {
  global $conn;
  $id = mysqli_real_escape_string($conn, $datos['id']);
  $fecha = mysqli_real_escape_string($conn, $datos['fecha']);
  $hora = mysqli_real_escape_string($conn, $datos['hora']);
  $matricula = mysqli_real_escape_string($conn, $datos['matricula']);
  $equipo = mysqli_real_escape_string($conn, $datos['equipo']);
  $comandante = mysqli_real_escape_string($conn, $datos['comandante']);
  $licencia_comandante = mysqli_real_escape_string($conn, $datos['licencia_comandante']);
  $sub_comandante = mysqli_real_escape_string($conn, $datos['sub_comandante']);
  $licencia_sub_comandante = mysqli_real_escape_string($conn, $datos['licencia_sub_comandante']);
  $num_pasajeros = mysqli_real_escape_string($conn, $datos['num_pasajeros']);

  $sql = "UPDATE aviones SET 
          fecha = '$fecha', 
          hora = '$hora', 
          matricula = '$matricula', 
          equipo = '$equipo', 
          comandante = '$comandante', 
          licencia_comandante = '$licencia_comandante', 
          sub_comandante = '$sub_comandante', 
          licencia_sub_comandante = '$licencia_sub_comandante', 
          num_pasajeros = '$num_pasajeros' 
          WHERE id = '$id'";

  return $conn->query($sql);
}

function buscarAvionesPorFecha($fecha) {
  global $conn;
  $fecha = mysqli_real_escape_string($conn, $fecha);
  $sql = "SELECT * FROM aviones WHERE fecha = '$fecha' ORDER BY hora";
  $result = $conn->query($sql);
  $registros = [];
  while ($row = $result->fetch_assoc()) {
    $registros[] = $row;
  }
  return $registros;
}

function eliminarAvion($id) {
  global $conn;
  $id = mysqli_real_escape_string($conn, $id);
  $sql = "DELETE FROM aviones WHERE id = '$id'";
  return $conn->query($sql);
}

// Más funciones según sea necesario...
?>
