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

    <h1> Condicionales </h1>
    <form action="condicional.php" method="POST">
        <table border="5" bordercolor="orange">
            <tr>
                <th colspan="2"> Calculadora Criolla</th>
            </tr>
            <tr>
                <th>numero 1</th>
                <td><input type="text" name="numero1" value="5"></td>
            </tr>
            <tr>
                <th>numero 2</th>
                <td><input type="text" name="numero2" value="2"></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="operacion" value="+">
                    <input type="submit" name="operacion" value="-">
                </td>
                <td>
                    <input type="submit" name="operacion" value="*">
                    <input type="submit" name="operacion" value="/">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="operacion" value="R">
                    <input type="submit" name="operacion" value="S">
                </td>
                <td>
                    <input type="submit" name="operacion" value="T">
                    <input type="submit" name="operacion" value="L">
                </td>
            </tr>
        </table>
    </form>
    <br>
    <?php

    if (isset($_POST['operacion'])) {
        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];
        $operacion = $_POST['operacion'];
        $rta = 0;

        if ($operacion == "+") {
            $rta = $numero1 + $numero2;
        }
        if ($operacion == "-") {
            $rta = $numero1 - $numero2;
        }
        if ($operacion == "R") {
            $rta = sqrt($numero1);
        }
        if ($operacion == "S") {
            $rta = sin($numero1);
        }

        echo "<div>La respuesta es <b> $rta </b> </div> ";
    }

    if (isset($_POST['operacion'])) {

        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];
        $operacion = $_POST['operacion'];
        switch ($operacion) {
            case "+":
                echo "Suma: " . ($numero1 + $numero2);
                break;
            case "-":
                echo "Resta: " . ($numero1 - $numero2);
                break;
            case "*":
                echo "Multiplicacion: " . ($numero1 * $numero2);
                break;
            case "/":
                echo "Division: " . ($numero1 / $numero2);
                break;
            case "R":
                echo "Raiz: " . sqrt($numero1);
                break;
            case "S":
                echo "Seno: " . sin($numero1);
                break;
            case "T":
                echo "Tangente: " . tan($numero1);
                break;
            case "L":
                echo "Log: " . log($numero1);
                break;
        }
    }

    ?>

</section>
<footer></footer>

</html>