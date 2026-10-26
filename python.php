<?php
session_start();
require 'manualPython/control_sesion.php';
//datos de la base de datos
$loginUsuario = "admin";
$claveUsuario = "123";
$nombre = "Elton Tito";
$error = '';
if (isset($_POST['enviar'])) {
    $login = $_POST['login'];
    $clave = $_POST['clave'];

    if (($login == $loginUsuario) && ($clave == $claveUsuario)) {
        iniciarSesionManual($nombre);
        header('Location: manualPython/index.php');
        exit();
    } else {
        $error = "<p class='alerta alerta-error'>Usuario o contraseña incorrectos</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al manual de Python</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php
    include 'menu.html';
    ?>
    <section class="acceso">
        <div class="acceso-tarjeta">
            <?php include 'manualPython/saludo.php'; ?>
            <p class="acceso-etiqueta">Área privada</p>
            <h1>Acceder al manual de Python</h1>
            <p class="acceso-texto">Inicia sesión para ver el manual y el sistema de análisis de datos.</p>

            <?php if ($error !== '') echo $error; ?>

            <form action="python.php" method="POST" class="acceso-formulario">
                <label for="login">Usuario</label>
                <input type="text" id="login" name="login" autocomplete="username" required autofocus>

                <label for="clave">Contraseña</label>
                <input type="password" id="clave" name="clave" autocomplete="current-password" required>

                <div class="acceso-botones">
                    <input type="submit" name="enviar" value="Ingresar">
                    <input type="reset" value="Limpiar">
                </div>
            </form>
        </div>
    </section>
    <?php include 'pie.html'; ?>
</body>

</html>