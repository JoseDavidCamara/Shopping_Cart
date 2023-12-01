<?php
session_start();

require_once '../Business/ProductClass.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["agregarAlCarrito"])) {
        $itemCifrado = $_GET["agregarAlCarrito"];
        $item = json_decode(urldecode($itemCifrado), true);

        // Crear una nueva instancia de la clase Product
        $product = new Product($item['id'], $item['product_name'], $item['description'], $item['price'], 1, $item['url_imagen']);

        if (isset($_SESSION["carrito"])) {
            $carrito = $_SESSION["carrito"];

            // Evitar duplicado
            $productAlreadyInCart = false;

            foreach ($carrito as $key => $item) {
                $listitem = unserialize($item);

                if ($product->getName() == $listitem->getName()) {
                    unset($_SESSION["carrito"][$key]);
                    $productAlreadyInCart = true;
                    break;
                }
            }

            // Agregar el nuevo producto solo si no está en el carrito
            if (!$productAlreadyInCart) {
                $carrito[] = serialize($product);
                $message = "Producto agregado al carrito.";
            } else {
                $message = "Este producto ya está en el carrito.";
            }
        } else {
            $carrito = array();
            $carrito[] = serialize($product);
            $message = "Producto agregado al carrito.";
        }

        $_SESSION["carrito"] = $carrito;

        // Enviar el mensaje de vuelta al JavaScript
        echo json_encode(["success" => true, "message" => $message]);
    }
}
?>
