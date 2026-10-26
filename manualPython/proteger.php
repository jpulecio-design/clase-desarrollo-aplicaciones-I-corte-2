<?php
// Se incluye al inicio de cada página del manual:
// si no hay sesión iniciada (o ya expiró), redirige al login
require_once __DIR__ . '/control_sesion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!sesionValida()) {
    session_unset();
    session_destroy();
    header('Location: ../python.php');
    exit();
}

$_SESSION['ultimo_acceso'] = time();
