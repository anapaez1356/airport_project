<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'trabajador') {
  header("Location: ../vistas/login.php");
  exit();
}

include '../includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $datos = [
    'fecha' => $_POST['fecha'],
    'hora' => $_POST['hora'],
    'matricula' => $_POST['matricula'],
    'equipo' => $_POST['equipo'],
    'comandante' => $_POST['comandante'],
    'licencia_comandante' => $_POST['licencia_comandante'],
    'sub_comandante' => $_POST['sub_comandante'],
    'licencia_sub_comandante' => $_POST['licencia_sub_comandante'],
    'num_pasajeros' => $_POST['num_pasajeros'],
  ];
  if (registrarAvion($datos)) {
    $mensaje = "Avión registrado con éxito";
  } else {
    $error = "Error al registrar el avión";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Trabajador</title>
  <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
  <div class="container">
    <h2>Registrar Avión</h2>
    <form method="POST">
      <input type="date" name="fecha" required>
      <input type="time" name="hora" required>
      <input type="text" name="matricula" placeholder="Matrícula" required>
      <input type="text" name="equipo" placeholder="Equipo" required>
      <input type="text" name="comandante" placeholder="Comandante" required>
      <input type="text" name="licencia_comandante" placeholder="Licencia Comandante" required>
      <input type="text" name="sub_comandante" placeholder="Sub Comandante">
      <input type="text" name="licencia_sub_comandante" placeholder="Licencia Sub Comandante">
      <input type="number" name="num_pasajeros" placeholder="Número de Pasajeros" required>
      <button type="submit">Registrar</button>
    </form>
    <?php if (isset($mensaje)) { echo "<p>$mensaje</p>"; } ?>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    
    <div class="botones-nav">
      <a href="registros_aviones.php" class="btn">Registros</a>
      <a href="../logout.php" class="btn">Cerrar Sesión</a>
    </div>
  </div>
</body>
</html>


