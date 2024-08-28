<?php
include '../includes/funciones.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];
  $user = iniciarSesion($usuario, $contrasena);
  if ($user) {
    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['rol'] = $user['rol'];
    header("Location: ../index.php");
    exit();
  } else {
    $error = "Usuario o contraseña incorrectos";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
 body {
  font-family: Arial, sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
  background-color: #f5f5f5;
}

form {
  background-color: #1a1b26;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  width: 300px;
  color: white;
}

h2 {
  text-align: center;
  color: white;
  margin-bottom: 20px;
  font-size: 24px;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #2a2b36;
  border-radius: 4px;
  box-sizing: border-box;
  background-color: #2a2b36;
  color: white;
}

input::placeholder {
  color: #6c7293;
}

button {
  width: 100%;
  padding: 10px;
  background-color: #0000FF; /* Cambiado a azul */
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  margin-top: 10px;
}

button:hover {
  background-color: #0000DD; /* Un tono más oscuro de azul para el hover */
}

p {
  color: red;
  text-align: center;
}

.forgot-password {
  text-align: right;
  font-size: 14px;
  margin-bottom: 15px;
}

.forgot-password a {
  color: #7e57c2;
  text-decoration: none;
}

/* Estilos adicionales para los elementos que no están en el HTML original */
.social-login {
  text-align: center;
  margin-top: 20px;
  color: #6c7293;
  font-size: 14px;
}

.social-icons {
  display: flex;
  justify-content: center;
  margin-top: 10px;
}

.social-icons a {
  margin: 0 10px;
  color: white;
  text-decoration: none;
}

.signup {
  text-align: center;
  margin-top: 20px;
  font-size: 14px;
  color: #6c7293;
}

.signup a {
  color: #7e57c2;
  text-decoration: none;
}
  </style>
</head>
<body>
  <form method="POST">
    <h2>Inicia Sesión</h2>
    <input type="text" name="usuario" placeholder="Usuario" required>
    <input type="password" name="contrasena" placeholder="Password" required>
    <div class="forgot-password">
      <a href="#"></a>
    </div>
    <button type="submit">Iniciar</button>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
  </form>
</body>
</html>