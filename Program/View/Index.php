<?php
session_start();
require_once '../Business/ProductClass.php';
require_once '../Business/UsuarioServicio.php';

if (!isset($_SESSION['usu_nombre'])) {
    header("Location: login.php");
}
echo "<form method=\"get\">";
echo "<label for=\"nombre\">Buscar por nombre:</label>";
echo "<input type=\"text\" name=\"nombre\" id=\"nombre\">";
echo "<br>";
echo "<label for=\"precio_min\">Precio mínimo:</label>";
echo "<input type=\"number\" name=\"precio_min\" id=\"precio_min\">";
echo "<br>";
echo "<label for=\"precio_max\">Precio máximo:</label>";
echo "<input type=\"number\" name=\"precio_max\" id=\"precio_max\">";
echo "<br>";
echo "<input type=\"submit\" value=\"Buscar\">";
echo "</form>";
echo "<form action=\"logout.php\"><input type=\"submit\" value=\"Cerrar sesión\"></form><br>";

$listado = arrayClass(
    isset($_GET['nombre']) ? $_GET['nombre'] : null,
    isset($_GET['precio_max']) ? $_GET['precio_max'] : null,
    isset($_GET['precio_min']) ? $_GET['precio_min'] : null
);

foreach ($listado as $item) {
    echo "Nombre del producto: " . $item->getName() . "<br>";
    echo "Descripción del producto: " . $item->getDescription() . "<br>";
    echo "Precio del producto: " . $item->getPrice() . "<br><br><br>";
}
?>
