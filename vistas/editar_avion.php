<?php
session_start();
if (!isset($_SESSION['usuario']) || ($_SESSION['rol'] != 'trabajador' && $_SESSION['rol'] != 'comandante')) {
  header("Location: ../vistas/login.php");
  exit();
}

include '../includes/funciones.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
  header("Location: registros_aviones.php");
  exit();
}

$avion = obtenerAvionPorId($id);

if (!$avion) {
  header("Location: registros_aviones.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $datos = [
    'id' => $id,
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
  if (actualizarAvion($datos)) {
    $mensaje = "Avión actualizado con éxito";
    $avion = obtenerAvionPorId($id); // Recargar los datos actualizados
  } else {
    $error = "Error al actualizar el avión";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Avión</title>
    <link rel="stylesheet" href="../css/aviones.css">
</head>
<body>
    <div class="container">
        <h2>Editar Avión</h2>
        <form method="POST" class="form-avion">
            <input type="date" name="fecha" value="<?php echo $avion['fecha']; ?>" required>
            <input type="time" name="hora" value="<?php echo $avion['hora']; ?>" required>
            <input type="text" name="matricula" value="<?php echo $avion['matricula']; ?>" placeholder="Matrícula" required>
            <input type="text" name="equipo" value="<?php echo $avion['equipo']; ?>" placeholder="Equipo" required>
            <input type="text" name="comandante" value="<?php echo $avion['comandante']; ?>" placeholder="Comandante" required>
            <input type="text" name="licencia_comandante" value="<?php echo $avion['licencia_comandante']; ?>" placeholder="Licencia Comandante" required>
            <input type="text" name="sub_comandante" value="<?php echo $avion['sub_comandante']; ?>" placeholder="Sub Comandante">
            <input type="text" name="licencia_sub_comandante" value="<?php echo $avion['licencia_sub_comandante']; ?>" placeholder="Licencia Sub Comandante">
            <input type="number" name="num_pasajeros" value="<?php echo $avion['num_pasajeros']; ?>" placeholder="Número de Pasajeros" required>
            <button type="submit" class="btn-registrar">Actualizar</button>
        </form>
        <?php if (isset($mensaje)) { echo "<p class='mensaje'>$mensaje</p>"; } ?>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        
        <div class="botones-nav">
            <a href="registros_aviones.php" class="btn">Volver a Registros</a>
            
        </div>
    </div>
</body>
</html>