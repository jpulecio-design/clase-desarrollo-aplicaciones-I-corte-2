<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Página inicial</title>

    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php
    include 'menu.html';
    ?>

    <section id="inicio" class="seccion hero-info">
        <h2>Bienvenido al mundo de PHP</h2>
        <p class="lead">
            PHP (<strong>PHP: Hypertext Preprocessor</strong>) es un lenguaje de programación
            de código abierto, especialmente diseñado para el desarrollo web y que puede
            incrustarse fácilmente en HTML. Se ejecuta en el <em>servidor</em>, generando
            contenido dinámico que el navegador recibe como HTML puro.
        </p>

        <div class="grid-cards">
            <div class="card">
                <div class="card-icon">🐘</div>
                <h3>Lenguaje del servidor</h3>
                <p>Se ejecuta en el backend, no en el navegador del usuario.</p>
            </div>
            <div class="card">
                <div class="card-icon">⚡</div>
                <h3>Rápido y dinámico</h3>
                <p>Genera contenido HTML en tiempo real según la petición.</p>
            </div>
            <div class="card">
                <div class="card-icon">🔓</div>
                <h3>Código abierto</h3>
                <p>Gratuito, con una comunidad enorme y miles de librerías.</p>
            </div>
            <div class="card">
                <div class="card-icon">🌐</div>
                <h3>Multiplataforma</h3>
                <p>Compatible con Windows, Linux y macOS sin cambios.</p>
            </div>
        </div>
    </section>

    <!-- QUE ES PHP -->
    <section id="que-es" class="seccion">
        <h2>¿Qué es PHP?</h2>
        <p>
            PHP es un lenguaje de scripting que se ejecuta del lado del servidor.
            Cuando un usuario solicita una página <code>.php</code>, el servidor
            procesa el código, genera HTML y lo envía al navegador. El usuario
            nunca ve el código PHP original, solo el resultado final.
        </p>

        <h3>Características principales</h3>
        <ul class="lista-caracteristicas">
            <li> Sintaxis sencilla y fácil de aprender</li>
            <li> Amplia integración con bases de datos (MySQL, PostgreSQL, etc.)</li>
            <li> Compatible con todos los servidores web populares (Apache, Nginx)</li>
            <li> Soporte para POO (Programación Orientada a Objetos)</li>
            <li> Gran cantidad de frameworks: Laravel, Symfony, CodeIgniter</li>
        </ul>
    </section>

    <!-- SECCIÓN CONCEPTOS -->
    <section id="conceptos" class="seccion">
        <h2>Conceptos fundamentales de PHP</h2>

        <div class="concepto">
            <h3>1. Variables</h3>
            <p>En PHP las variables empiezan con el símbolo <code>$</code> y no requieren declaración de tipo.</p>
            <pre><code>&lt;?php
$nombre = "Ana";
$edad = 25;
$precio = 19.99;
?&gt;</code></pre>
        </div>

        <div class="concepto">
            <h3>2. Tipos de datos</h3>
            <p>PHP maneja varios tipos: <code>string</code>, <code>int</code>, <code>float</code>, <code>bool</code>,
                <code>array</code>, <code>object</code>, <code>null</code>.
            </p>
            <pre><code>&lt;?php
$texto   = "Hola";       // string
$numero  = 42;           // int
$decimal = 3.14;         // float
$activo  = true;         // bool
$lista   = [1, 2, 3];    // array
?&gt;</code></pre>
        </div>

        <div class="concepto">
            <h3>3. Condicionales</h3>
            <p>Permiten ejecutar bloques de código según una condición.</p>
            <pre><code>&lt;?php
$edad = 18;

if ($edad >= 18) {
    echo "Eres mayor de edad";
} else {
    echo "Eres menor de edad";
}
?&gt;</code></pre>
        </div>

        <div class="concepto">
            <h3>4. Bucles</h3>
            <p>Repiten un bloque de código. Los más comunes son <code>for</code>, <code>while</code> y
                <code>foreach</code>.
            </p>
            <pre><code>&lt;?php
$frutas = ["Manzana", "Pera", "Uva"];

foreach ($frutas as $fruta) {
    echo $fruta . "&lt;br&gt;";
}
?&gt;</code></pre>
        </div>

        <div class="concepto">
            <h3>5. Funciones</h3>
            <p>Bloques reutilizables de código que reciben parámetros y pueden devolver valores.</p>
            <pre><code>&lt;?php
function saludar($nombre) {
    return "Hola, " . $nombre;
}

echo saludar("Carlos");
?&gt;</code></pre>
        </div>

        <div class="concepto">
            <h3>6. Superglobales</h3>
            <p>Variables predefinidas accesibles desde cualquier parte del script:</p>
            <ul class="lista-caracteristicas">
                <li><code>$_GET</code> – Datos enviados por URL</li>
                <li><code>$_POST</code> – Datos enviados por formulario</li>
                <li><code>$_SESSION</code> – Datos persistentes del usuario</li>
                <li><code>$_COOKIE</code> – Datos almacenados en el navegador</li>
                <li><code>$_SERVER</code> – Información del servidor</li>
            </ul>
        </div>
    </section>


    <main class="contenido">
        <!-- SECCIÓN EJEMPLO -->
        <section id="ejemplo" class="seccion">
            <h2>Ejemplo completo</h2>
            <p>Un pequeño script que combina varios conceptos:</p>
            <pre><code>&lt;?php
$usuario = "Ana";
$carrito = ["Libro", "Cuaderno", "Lápiz"];
$total = 0;

foreach ($carrito as $producto) {
    $total += 5;
    echo "Producto: $producto &lt;br&gt;";
}

echo "Hola $usuario, tu total es: $$total";
?&gt;</code></pre>

            <p class="nota">
                <strong>Recuerda:</strong> todo el código PHP se escribe entre las etiquetas
                <code>&lt;?php ... ?&gt;</code> y se ejecuta en el servidor antes de enviar la respuesta.
            </p>
        </section>

    </main>

    <script src="script.js"></script>

    <footer>

    </footer>

</body>

</html>