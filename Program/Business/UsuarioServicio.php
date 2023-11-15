<?php
require_once '../DataAccess/UsuarioDAO.php';

class UsuarioServicio {
    private $usuario_dao;

    public function __construct() {
        $this->usuario_dao = new UsuarioDAO();
    }

    public function iniciar_sesion($correo, $contrasena) {
        return $this->usuario_dao->validar_credenciales($correo, $contrasena);
    }
}