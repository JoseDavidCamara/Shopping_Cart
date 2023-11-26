<?php 
session_start();

require_once '../Business/ProductClass.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if(isset($_GET["agregarAlCarrito"])) {
        $itemCifrado = $_GET["agregarAlCarrito"];
        $item = json_decode(urldecode($itemCifrado), true);
        // Crear una nueva instancia de la clase Product


        
        $product = new Product($item['id'], $item['product_name'], $item['description'], $item['price']);

        if (isset($_SESSION["carrito"])) {
            $carrito = $_SESSION["carrito"];
        
            // Evitar duplicado
            $productAlreadyInCart = false;
        
            foreach ($carrito as $key => $item) {
                $listitem = unserialize($item);
        
                if ($product->product_name == $listitem->product_name) {
                    unset($_SESSION["carrito"][$key]);
                    $productAlreadyInCart = true;
                    break;
                }
            }
        
            // Agregar el nuevo producto solo si no está en el carrito
            if (!$productAlreadyInCart) {
                $carrito[] = serialize($product);
            }
        } else {
            $carrito = array(); 
        }
        
        print_r($product);
        
        $_SESSION["carrito"] = $carrito;
    }
}

// print_r($_SESSION["carrito"]);

 header("Location: index.php");
?>
