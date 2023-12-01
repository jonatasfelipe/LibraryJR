<?php

namespace LibraryJr\controllers;

use LibraryJr\models\UsuarioModel;

class UsuarioController
{
    private $usuarioModel;

    public function __construct($pdo)
    {
        $this->usuarioModel = new UsuarioModel($pdo);
    }

    public function criarUsuario($nome_completo, $data_nascimento, $email, $telefone, $cpf, $usuario, $senha)
    {
        $this->usuarioModel->criarUsuario($nome_completo, $data_nascimento, $email, $telefone, $cpf, $usuario, $senha);
    }

    public function listarUsuarios()
    {
        return $this->usuarioModel->listarUsuarios();
    }

    public function fazerLogin($usuario, $senha)
    {
        $resultado = $this->usuarioModel->fazerLogin($usuario, $senha);

        if(sizeof($resultado) == 1){
            $_SESSION['LOGIN'] = TRUE;
            $_SESSION['USUARIO'] = $resultado;
        } else {
            $_SESSION['LOGIN'] = FALSE;
        }

        return $resultado;

    }

    public function fazerLogout($id_usuario){
        
        if(!is_null($id_usuario)){
            unset($_SESSION);
        }
    }
}
