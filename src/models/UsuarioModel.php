<?php

namespace LibraryJr\models;
use PDO;

class UsuarioModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function criarUsuario($nome_completo, $data_nascimento, $email, $telefone, $cpf, $usuario, $senha, $nivel_permissao)
    {
        $sql = "INSERT INTO usuarios (nome_completo, data_nascimento, email, telefone, cpf, usuario, senha, nivel_permissao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome_completo, $data_nascimento, $email, $telefone, $cpf, $usuario, $senha, $nivel_permissao]);
    }

    public function listarUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fazerLogin($usuario, $senha){
        $sql = "SELECT * FROM usuarios WHERE usuario = ? AND senha = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usuario, $senha]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Implementar métodos para atualizar e excluir esportes
}
