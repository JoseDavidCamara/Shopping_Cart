<?php
require_once '../DataAccess/ProductosDAO.php';
class Product
{

    public function __construct(
        protected int $id,
        protected string $product_name,
        protected string $description,
        protected float $price,
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

    //methods
}

/*now i have to take the list from de ProductosDAO, i make 
 the split in 4 position to take the values of each product
*/

function arrayClass($fNombre = null, $fMaxP = null, $fMinP = null)
{
    //The first step is get the list from ProductosDao();
    $consulta = devolver_productos($fNombre, $fMaxP, $fMinP);
    $listProductoClases = [];

    //Iterate through the list to get the values of each product and add it to a new Class
    //Pasa el resultado de la consulta a una lista de la clase producto
    while ($registro = $consulta->fetch()) {
        $product = new Product($registro['id_producto'], $registro['nombre_producto'], $registro['descripcion'], $registro['precio']);
        array_push($listProductoClases, $product);
    }
    //return the new list with the classes
    return $listProductoClases;
}
