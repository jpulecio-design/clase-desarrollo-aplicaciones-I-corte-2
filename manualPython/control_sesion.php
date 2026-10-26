<?php
// Funciones para validar que la sesión del manual siga siendo válida

// Minutos sin actividad antes de cerrar la sesión automáticamente
const MINUTOS_INACTIVIDAD = 30;

// Devuelve la hora en que arrancó Apache (fecha del archivo httpd.pid).
// Cada vez que se enciende XAMPP ese archivo se vuelve a crear, así que
// si cambia sabemos que el servidor se reinició. Si no se encuentra, devuelve null.
function arranqueServidor()
{
    $pid = dirname($_SERVER['DOCUMENT_ROOT']) . '/apache/logs/httpd.pid';
    return is_file($pid) ? filemtime($pid) : null;
}

// Marca la sesión como autenticada (se llama al hacer login correcto)
function iniciarSesionManual($nombre)
{
    session_regenerate_id(true); // nuevo id para evitar reutilizar sesiones viejas
    $_SESSION['nombre'] = $nombre;
    $_SESSION['autenticado'] = true;
    $_SESSION['arranque'] = arranqueServidor();
    $_SESSION['ultimo_acceso'] = time();
}

// Indica si la sesión actual es válida para entrar al manual
function sesionValida()
{
    if (empty($_SESSION['autenticado'])) {
        return false;
    }
    // Se apagó y volvió a encender XAMPP desde el login
    if (($_SESSION['arranque'] ?? null) !== arranqueServidor()) {
        return false;
    }
    // Demasiado tiempo sin actividad
    if (time() - ($_SESSION['ultimo_acceso'] ?? 0) > MINUTOS_INACTIVIDAD * 60) {
        return false;
    }
    return true;
}
