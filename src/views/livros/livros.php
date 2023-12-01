<?php 
namespace LibraryJr\views\livros;
session_start();
require_once "C:/xampp/htdocs/LibraryJR/vendor/autoload.php";


use LibraryJr\config\DatabaseConnection;
use LibraryJr\controllers\{UsuarioController, LivroController};

$databaseConnection = new DatabaseConnection();
$pdo = $databaseConnection->getConnection();

$livroController = new LivroController($pdo);

if(isset($_SESSION['USUARIO'])){
    $livroController->exibirListaLivros();
} else {
    header('Location: ../../../index.php');
}

?>