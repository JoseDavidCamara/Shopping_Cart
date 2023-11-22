//arreglar el nav, no se pone correctamente
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
            color: #ffffff;
        }

        .navbar-brand {
            color: #ffffff;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            margin-top: 20px;
            padding: 20px;
        }

        /* Center the form */
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Mi Tienda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Carrito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        <main>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Información de facturación</h4>
                <form class="needs-validation" novalidate>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 Calle Principal" required>
                            <div class="invalid-feedback">
                                Por favor, ingresa tu dirección de envío.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label">Dirección 2 <span class="text-muted">(Opcional)</span></label>
                            <input type="text" class="form-control" id="address2" placeholder="Apartamento o Suite">
                        </div>

                        <div class="col-md-6">
                            
                            <label for="country" class="form-label">País</label>
                            <div class="input-group">
                                <select class="form-select" id="country" required>
                                    <option value="" selected>Selecciona...</option>
                                    <option value="Estados Unidos">Estados Unidos</option>
                                    <!-- Agrega más opciones de países según sea necesario -->
                                </select>
                            </div>
                            <div class="invalid-feedback">
                                Por favor, selecciona un país válido.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="state" class="form-label">Estado</label>
                            <select class="form-select" id="state" required>
                                <option value="">Selecciona...</option>
                                <option>California</option>
                                <!-- Agrega más opciones de estados según sea necesario -->
                            </select>
                            <div class="invalid-feedback">
                                Por favor, proporciona un estado válido.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="zip" class="form-label">Código Postal</label>
                            <input type="text" class="form-control" id="zip" placeholder="" required>
                            <div class="invalid-feedback">
                                Se requiere el código postal.
                            </div>
                        </div>

                        <!-- Detalles de pago -->
                        <div class="col-12">
                            <hr class="my-4">
                            <h4 class="mb-3">Detalles de pago</h4>
                        </div>

                        <div class="col-md-6">
                            <label for="cc-name" class="form-label">Nombre en la tarjeta</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required>
                            <small class="text-muted">Nombre completo como aparece en la tarjeta</small>
                            <div class="invalid-feedback">
                                Se requiere el nombre en la tarjeta.
                            </div>
                        </div>

                        <!-- Resto del formulario sigue aquí -->

                        <div class="col-12">
                            <hr class="my-4">
                        </div>

                        <div class="col-12">
                            <button class="w-100 btn btn-primary btn-lg" type="submit">Continuar con la compra</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>
</body>

</html>