<?php

namespace LibraryJr\models;
use PDO;

class LivroModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function criarLivro($titulo, $autor, $editora, $num_pags, $livros_disp)
    {
        $sql = "INSERT INTO livros (titulo, autor, editora, num_pags, livros_disp) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$titulo, $autor, $editora, $num_pags, $livros_disp]);
    }

    public function listarLivros()
    {
        $sql = "SELECT * FROM livros";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Implementar métodos para atualizar e excluir livros
}
