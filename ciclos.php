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

    <section>

        <h1> Ciclos </h1>
        Tipos de ciclos php
        <h2> While </h2>
        Ejecuta el bloque mientras la condición sea verdadera. La condición se evalúa antes de cada iteración.
        <table border="2" align="center">
            <tr>
                <th>WHILE</th>
                <th>DO---WHILE</th>
            </tr>
            <tr>
                <TD>
                    <?php
                    $n = 1;
                    while ($n <= 6) {
                        echo "<h$n>Buen dia </h$n>";
                        $n++;
                    }
                    ?>
                </TD>
                <TD>
                    <?php
                    $k = 1;
                    do {
                        echo "Numero: $k";
                        $k++;
                    } while ($k <= 7); ?>
                </TD>
            </tr>
        </table>
        <h2> do....While </h2>
        Similar a while, pero la condición se evalúa después de ejecutar el bloque. Siempre se ejecuta al menos una vez.
        <h2> For </h2>
        Se usa cuando se conoce el número de iteraciones. Tiene 3 partes: inicialización, condición e incremento.
        <form action="ciclos.php" method="get">
            <table border="2" bordercolor="orange">
                <tr>
                    <th colspan="2"> Elegir tabla de multiplicar</th>
                </tr>
                <tr>
                    <th>NUMERO</th>
                    <td><input type="number" name="numero"></td>
                </tr>
                <tr>
                    <td> <input type="submit" name="enviar">

                    </td>
                    <td> <input type="submit" name = "todo" value="todo">

                    </td>
                </tr>
            </table>
        </form>
        <?php
            $numero = $_GET['numero'];
            echo "<table border=5 width = 300 cellspacing = 10 cellspadding = 10>";
            echo "<tr><th colspan = 5> Tabla del $numero</th> </tr>";
            for ($k = 1; $k <= 10; $k++) {
                echo "<tr> <td>$k <td>* <td>$numero <td> = <td>" . ($k * $numero) . "</tr>";
            }
            echo "</table>";
            if(isset($_GET['todo'])){    
                $numero = $_GET['numero'];
                for($tabla = 1; $tabla <= 10; $tabla++){
                    echo "<table border=5 width = 300>";
                    echo "<tr><th colspan = 5> Tabla del $tabla</th> </tr>";
                    //ciclo pa tablas
                    //ciclo pa multiplicar
                    echo "</table>";

                }
            }
        
        ?>
        <h2> For Each </h2>
        Recorre arrays u objetos. Es el más usado para arreglos.

    </section>

    <footer></footer>

</body>

</html>