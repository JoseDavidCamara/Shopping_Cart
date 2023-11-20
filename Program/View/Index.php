<?php
session_start();
require_once '../Business/UsuarioServicio.php';

if (!isset($_SESSION['usu_nombre'])) {
    header("Location: login.php");
}
else{
    echo $_SESSION['usu_nombre'];
}

?>