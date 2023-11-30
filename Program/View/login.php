<?php
session_start();
require_once '../Business/UsuarioServicio.php';
$modoOscuroCookie = isset($_COOKIE['modo_oscuro']) ? $_COOKIE['modo_oscuro'] : 'false';
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

$darkModeClass = $modoOscuroCookie === 'true' ? '' : 'dark-mode';

?>

<!DOCTYPE html >
<html lang="es" class="<?= $darkModeClass ?>" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/login.css">
</head>
<body>
<?php include 'navbar.inc'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Login</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="login.php">
                        <div class="form-group ">
                            <label for="correo">Correo:</label>
                            <input type="text" class="form-control" name="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Contraseña:</label>
                            <input type="password" class="form-control" name="contrasena" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary">Iniciar sesión</button>
                        </div>
                    </form>
                    <?php if (isset($error)) echo "<div class='alert alert-danger mt-3'>$error</div>"; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to toggle dark mode and set the cookie
    function toggleDarkMode() {
        document.documentElement.classList.toggle('dark-mode');
        const isDarkMode = document.documentElement.classList.contains('dark-mode');
        document.cookie = `modo_oscuro=${isDarkMode}; path=/`;
    }
</script>

<!-- Agrega la referencia a Bootstrap JS y Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>