<?php 
 function Conexion()
{
    $host="localhost";
    $nombreDB="shopping_cart";
    $usuario="root";
    $password="";
    
    return new PDO("mysql:host=$host;dbname=$nombreDB;charset0utf8",$usuario,$password);
}
