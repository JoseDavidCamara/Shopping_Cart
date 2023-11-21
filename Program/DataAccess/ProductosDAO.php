<?php 
require 'conexion.php';

function devolver_productos()
{
    $conexion=Conexion();
    try{
        $consulta=$conexion->prepare("SELECT * FROM productos");
        $consulta->execute();

        return $consulta;
    }
    catch (PDOException $e)
    {
      die("Error al ejecutar la consulta: ". $e->getMessage());
    }
}
  
//dDEspues de mostrar el producto , añadir un array d sesion lo de añadir el producto cada vez que presionas un producto y después hacer modificar cantidad
