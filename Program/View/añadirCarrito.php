<?php 
session_start();

require_once '../Business/ProductClass.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if(isset($_GET["agregarAlCarrito"])) {
        $itemCifrado = $_GET["agregarAlCarrito"];
        $item = json_decode(urldecode($itemCifrado), true);
        // Crear una nueva instancia de la clase Product
        $product = new Product($item['id'], $item['product_name'], $item['description'], $item['price']);

        if(isset($_SESSION["carrito"])) {
            $carrito = $_SESSION["carrito"];
        } else {
            $carrito = array(); 
        }
        print_r($product);

        $carrito[] = serialize($product);

        $_SESSION["carrito"] = $carrito;
    }
}

// print_r($_SESSION["carrito"]);

 header("Location: index.php");
?>
