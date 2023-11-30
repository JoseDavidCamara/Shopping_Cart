<?php
require_once('../DataAccess/PedidosDAO.php');
class Pedido
{
  
    public function __construct(
        public $nombre_producto,
        public $cantidad,
        public $fecha_pedido,
    
    ){}

    public function getNombreProducto()
    {
        return $this->nombre_producto;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getFechaPedido()
    {
        return $this->fecha_pedido;
    }
    
    
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

function listaPedido($id_usuario,$fecha = null)
{
   $consulta= pedidos($id_usuario, $fecha);
   $listadopedidos=[];

   while($registro=$consulta->fetch()){
     $pedido= new Pedido($registro['nombre_producto'],$registro['cantidad'],$registro['fecha_pedido']);
     array_push($listadopedidos,$pedido);
   }

   return $listadopedidos;

}
