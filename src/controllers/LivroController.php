<?php

namespace LibraryJr\controllers;

use LibraryJr\models\LivroModel;

class LivroController
{
    private $livroModel;

    public function __construct($pdo)
    {
        $this->livroModel = new LivroModel($pdo);
    }

    public function criarLivro($titulo, $autor, $editora, $num_pags, $livros_disp)
    {
        $this->livroModel->criarLivro($titulo, $autor, $editora, $num_pags, $livros_disp);
    }

    public function listarLivros()
    {
        return $this->livroModel->listarLivros();
    }

    public function exibirListaLivros()
    {
        $livros = $this->livroModel->listarLivros();
        if ($livros != null) {
            include_once 'src/views/livros/lista.php';
        } else {
            echo "Não existem livros cadastrados!";
        }
    }
}
