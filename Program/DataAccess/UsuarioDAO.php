<?php

require_once 'conexion.php';

class UsuarioDAO {

    public function validar_credenciales($correo, $contrasena) {
        $conexion =Conexion();
        try {
            $consulta = "SELECT * FROM usuarios WHERE email=:correo AND contraseña=:contrasena";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->bindParam(':correo', $correo, PDO::PARAM_STR);
            $sentencia->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $sentencia->execute();

            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }

    public function insertar_usuario($nombre, $email, $contrasena) {
        $conexion = Conexion();
        try {
            $consulta_verificar = "SELECT COUNT(*) as total FROM usuarios WHERE email=:email";
            $sentencia_verificar = $conexion->prepare($consulta_verificar);
            $sentencia_verificar->bindParam(':email', $email, PDO::PARAM_STR);
            $sentencia_verificar->execute();
    
            $resultado_verificar = $sentencia_verificar->fetch(PDO::FETCH_ASSOC);
    
            if ($resultado_verificar['total'] > 0) {
                return false;
            }
    
            $consulta_insertar = "INSERT INTO usuarios (nombre, email, contraseña) VALUES (:nombre, :email, :contrasena)";
            $sentencia_insertar = $conexion->prepare($consulta_insertar);
            $sentencia_insertar->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $sentencia_insertar->bindParam(':email', $email, PDO::PARAM_STR);
            $sentencia_insertar->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $sentencia_insertar->execute();
    
            return true;
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }
}
?>
