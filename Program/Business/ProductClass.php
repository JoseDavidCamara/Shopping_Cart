<?php
require_once '../DataAccess/ProductosDAO.php';
class Product
{

    public function __construct(
        public int $id,
        public string $product_name,
        public string $description,
        public float $price,
        public int $quantity,
    ) {
    }


    //getters
    
    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->product_name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    //setters

    public function setProductName($productName)
    {
        $this->product_name = $productName;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    //methods
}



function arrayClass($fNombre = null, $fMaxP = null, $fMinP = null)
{
    //The first step is get the list from ProductosDao();
    $consulta = devolver_productos($fNombre, $fMaxP, $fMinP);
    $listProductoClases = [];

    //Iterate through the list to get the values of each product and add it to a new Class
    //Pasa el resultado de la consulta a una lista de la clase producto
    while ($registro = $consulta->fetch()) {
        $product = new Product($registro['id_producto'], $registro['nombre_producto'], $registro['descripcion'], $registro['precio'],1);
        array_push($listProductoClases, $product);
    }
    //return the new list with the classes
    return $listProductoClases;
}
