<?php
session_start();
require_once '../Business/ProductClass.php';
require_once '../Business/UsuarioServicio.php';

if (!isset($_SESSION['usu_nombre'])) {
    header("Location: login.php");
}
echo "<form action=\"logout.php\"><input type=\"submit\" value=\"Cerrar sesión\"></form><br>";


$listado = arrayClass();


//hacer foreach para todos los productos con sus datos

foreach ($listado as $item) {
    echo "Nombre del producto :" . $item->getName() . "<br>";
    echo "Descripcion del producto :" . $item->getDescription() . "<br>";
    echo "Precio del producto :" . $item->getPrice() . "<br><br><br>";
    //I can use URLS to send the data to the cart.php like in the excercise, 
    //I have to do the button and session array deppending the user


}
