<?php
include '../includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];
  $rol = $_POST['rol'];
  if (registrarUsuario($usuario, $contrasena, $rol)) {
    header("Location: login.php");
    exit();
  } else {
    $error = "Error al registrar el usuario";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
  <form method="POST">
    <h2>Registro</h2>
    <input type="text" name="usuario" placeholder="Usuario" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <select name="rol" required>
      <option value="trabajador">Trabajador</option>
      <option value="comandante">Comandante</option>
    </select>
    <button type="submit">Registrar</button>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
  </form>
</body>
</html>
