<?php
require_once('../DataAccess/PedidosDAO.php');
class Pedido
{
  
    public function __construct(
        public $order_id,
        public $user_id,
        public $order_date,
    
    ){}

    public function getOrderId()
    {
        return $this->order_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getOrderDate()
    {
        return $this->order_date;
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

function BusinessOrderList($user_id)
{
   $consulta= ordersList($user_id);
   $ordersList=[];

   while($registro=$consulta->fetch()){
    // orders
   }


}
