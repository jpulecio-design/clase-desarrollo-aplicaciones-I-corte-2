<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina inicial</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php
    include 'menu.html';
    ?>
</body>
<section>
    Conceptos fundamentales de PHP
    <h1> Variables </h1>
    En PHP las variables empiezan con el símbolo $ y no requieren declaración de tipo.
    <?php
    $nombre = "Juan Andres Pulecio";
    echo "<br> Nombre $nombre ";

    $nombre = 19;
    echo "<br> Edad $nombre ";
    $nombre = true;
    echo "<br> Soltero $nombre ";
    if ($nombre == true) {
        echo "Esta soltero buscando una buena hembra";
    } else
        echo "JAJAJAJASJ No picha";

    ?>

</section>
<footer></footer>

</html>