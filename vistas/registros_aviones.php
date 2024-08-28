<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'trabajador') {
  header("Location: ../vistas/login.php");
  exit();
}

include '../includes/funciones.php';

// Obtener todos los registros de aviones
$registros = obtenerRegistros();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Aviones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/avion.css">
</head>
<body>
    <div class="container">
        <h1>Registros de Aviones</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Matrícula</th>
                        <th>Equipo</th>
                        <th>Comandante</th>
                        <th>Licencia Comandante</th>
                        <th>Sub Comandante</th>
                        <th>Licencia Sub Comandante</th>
                        <th>Número de Pasajeros</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $registro): ?>
                    <tr>
                        <td><?php echo $registro['fecha']; ?></td>
                        <td><?php echo $registro['hora']; ?></td>
                        <td><?php echo $registro['matricula']; ?></td>
                        <td><?php echo $registro['equipo']; ?></td>
                        <td><?php echo $registro['comandante']; ?></td>
                        <td><?php echo $registro['licencia_comandante']; ?></td>
                        <td><?php echo $registro['sub_comandante']; ?></td>
                        <td><?php echo $registro['licencia_sub_comandante']; ?></td>
                        <td><?php echo $registro['num_pasajeros']; ?></td>
                        <td>
                            <a href="editar_avion.php?id=<?php echo $registro['id']; ?>" class="btn-editar">Editar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="botones-nav">
            <a href="dashboard_trabajador.php" class="btn">Volver al Dashboard</a>
            <a href="../logout.php" class="btn">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>