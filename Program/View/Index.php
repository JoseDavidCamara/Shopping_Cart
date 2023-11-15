<?php
session_start();
require_once '../Business/UsuarioServicio.php';

if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
}

$correo = $_SESSION['correo'];
?>