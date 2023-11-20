<?php
// archivo: login.php
session_start();
require_once '../Business/UsuarioServicio.php';

if (isset($_POST['submit'])) {
    
    
    $data = iniciar_sesion($_POST['correo'], $_POST['contrasena']);
    if ($data) {
        $_SESSION['usu_id'] = $data->getId();
        $_SESSION['usu_nombre'] = $data->getNombre();
        $_SESSION['usu_correo'] = $data->getCorreo();

        header("Location: index.php");
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="login.php">
        Correo: <input type="text" name="correo" required><br>
        Contraseña: <input type="password" name="contrasena" required><br>
        <input type="submit" name="submit" value="Iniciar sesión">
    </form>
    <?php if (isset($error)) echo $error; ?>
</body>
</html>
