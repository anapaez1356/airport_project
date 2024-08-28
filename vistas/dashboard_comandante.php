<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'comandante') {
  header("Location: ../vistas/login.php");
  exit();
}

include '../includes/funciones.php';

// Obtener todos los registros de aviones
$registros = obtenerRegistros();

// Búsqueda por fecha
if (isset($_GET['fecha_busqueda'])) {
    $fecha_busqueda = $_GET['fecha_busqueda'];
    $registros = buscarAvionesPorFecha($fecha_busqueda);
}

// Eliminar avión
if (isset($_POST['eliminar'])) {
    $id_eliminar = $_POST['id_eliminar'];
    if (eliminarAvion($id_eliminar)) {
        $mensaje = "Avión eliminado con éxito";
        $registros = obtenerRegistros(); // Actualizar la lista
    } else {
        $error = "Error al eliminar el avión";
    }
}

// Registrar trabajador
if (isset($_POST['registrar_trabajador'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $rol = 'trabajador';
    if (registrarUsuario($usuario, $contrasena, $rol)) {
        $mensaje = "Trabajador registrado con éxito";
    } else {
        $error = "Error al registrar el trabajador";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comandante</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <header class="header">
      <h1>Bienvenido Comandante</h1>
      <div class="avatar">
        <?php echo substr($_SESSION['usuario'], 0, 1); ?>
      </div>
    </header>
    
    <div class="card">
      <h2>Búsqueda de Aviones</h2>
      <form method="GET" class="search-bar">
        <input type="date" name="fecha_busqueda">
        <button type="submit">Buscar</button>
      </form>
    </div>

    <div class="card">
      <h2>Registros de Aviones</h2>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Matricula</th>
              <th>Equipo</th>
              <th>Comandante</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($registros as $avion): ?>
            <tr>
              <td><?php echo $avion['fecha']; ?></td>
              <td><?php echo $avion['hora']; ?></td>
              <td><?php echo $avion['matricula']; ?></td>
              <td><?php echo $avion['equipo']; ?></td>
              <td><?php echo $avion['comandante']; ?></td>
              <td>
                <a href="editar_avion.php?id=<?php echo $avion['id']; ?>" class="btn btn-edit">Editar</a>
                
                <form method="POST" style="display:inline;">
                  <input type="hidden" name="id_eliminar" value="<?php echo $avion['id']; ?>">
                  <button type="submit" name="eliminar" class="btn btn-delete">Eliminar</button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="card">
      <h2>Registrar Nuevo Trabajador</h2>
      <form method="POST" class="form-registro">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <button type="submit" name="registrar_trabajador" class="btn">Registrar Trabajador</button>
      </form>
    </div>

    <?php if (isset($mensaje)) echo "<p class='mensaje'>$mensaje</p>"; ?>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

    <div class="logout">
      <a href="../logout.php" class="btn btn-logout">Cerrar Sesión</a>
    </div>
  </div>
</body>
</html>