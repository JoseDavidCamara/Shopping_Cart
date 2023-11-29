<?php
require_once '../DataAccess/UsuarioDAO.php';

class UsuarioServicio {
    private $id;
    private $nombre;
    private $correo;

    public function __construct($id,$nombre,$correo) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
    }
    public function getId() {
        return $this->id;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getCorreo() {
        return $this->correo;
    }
    
} 
function CrearUsuario($nombre, $correo, $contrasena) {
    $usuario_dao = new UsuarioDAO();
    $usuario_dao->insertar_usuario($nombre, $correo, $contrasena);
}
function iniciar_sesion($correo, $contrasena) {
    $usuario_dao = new UsuarioDAO();
     $data = $usuario_dao->validar_credenciales($correo, $contrasena);
    return new UsuarioServicio($data['id_usuario'], $data['nombre'], $data['email']);
}