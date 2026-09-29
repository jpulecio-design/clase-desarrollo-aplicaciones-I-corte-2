<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina inicial</title>
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
    $nombre = "Ena Mora de Alegria";
    echo "<br> Nombre $nombre ";

    $nombre = 20;
    echo "<br> Edad $nombre ";
    $nombre = true;
    echo "<br> Viuda $nombre ";
    if ($nombre == true) {
        echo "Esta viuda y a la orden chin chu macho";
    } else
        echo "No esta viuda ";

    ?>

</section>
<footer></footer>

</html>