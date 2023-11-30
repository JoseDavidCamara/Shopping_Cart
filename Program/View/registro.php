<?php
session_start();
require_once '../Business/UsuarioServicio.php';
$modoOscuroCookie = isset($_COOKIE['modo_oscuro']) ? $_COOKIE['modo_oscuro'] : 'false';
if (isset($_POST['submit'])) {
    try {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];

        if (filter_var($correo, FILTER_VALIDATE_EMAIL) && !empty($nombre) && !empty($contrasena)) {
            CrearUsuario($nombre, $correo, $contrasena);
            header("Location: login.php?registro=exitoso");
            exit();
        } else {
            throw new Exception("Los datos proporcionados no tienen el formato correcto.");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

$darkModeClass = $modoOscuroCookie === 'true' ? '' : 'dark-mode';
?>

<!DOCTYPE html >
<html lang="es" class="<?= $darkModeClass ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
       body {
            background-color: #343a40; /* Dark background color */
            color: #fff; /* Light text color */
        }

        .dark-mode body {
            background-color: #fff; /* Light background color in dark mode */
            color: #000; /* Dark text color in dark mode */
        }

        .card {
            background-color: #424a52; /* Dark card background color */
            color: #fff; /* Light text color for card content */
        }

        .dark-mode .card {
            background-color: #fff; /* Light card background color in dark mode */
            color: #000; /* Dark text color for card content in dark mode */
        }

        .form-control {
            background-color: #495057; /* Dark form input background color */
            color: #fff; /* Light text color for form input */
        }

        .dark-mode .form-control {
            background-color: #fff; /* Light form input background color in dark mode */
            color: #000; /* Dark text color for form input in dark mode */
        }

        .btn-primary {
            background-color: #007bff; /* Bootstrap primary color for the button */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker color on hover */
        }

        .dark-mode .btn-primary {
            background-color: #0056b3; /* Darker primary color in dark mode */
        }

        .dark-mode .btn-primary:hover {
            background-color: #003366; /* Darker color on hover in dark mode */
        }

        .alert {
            background-color: #dc3545; /* Bootstrap alert danger color */
            color: #fff; /* Light text color for alert */
        }

        .dark-mode .alert {
            background-color: #ff0000; /* Darker alert color in dark mode */
            color: #fff; /* Light text color for alert in dark mode */
        }
    </style>
</head>

<body >
<?php include 'navbar.inc'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Registro</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="registro.php">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo:</label>
                                <input type="email" class="form-control" name="correo" required>
                            </div>
                            <div class="form-group">
                                <label for="contrasena">Contraseña:</label>
                                <input type="password" class="form-control" name="contrasena" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Registrarse</button>
                            </div>
                        </form>
                        <?php if (isset($error)) echo "<div class='alert alert-danger mt-3'>$error</div>"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agrega la referencia a Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>