<?php
require_once('../DataAccess/PedidosDAO.php');
class Pedido
{
    private $id_pedido;
    private $id_usuario;
    private $fecha_pedido;
}

function añadirPedido($id_usu, $carrito)
{
    $id_pedido = insertarPedido($id_usu);

    if ($id_pedido !== null) {
        foreach ($carrito as $item) {
            $product = unserialize($item);
            añadirProductosAlPedido($id_pedido, $product->getID(), $product->getQuantity());
        }
    }
}
