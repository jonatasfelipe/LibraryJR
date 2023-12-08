<?php
namespace LibraryJr\views\usuarios;
session_start();
require_once "C:/xampp/htdocs/LibraryJR/vendor/autoload.php";

use LibraryJr\config\DatabaseConnection;
use LibraryJr\controllers\{UsuarioController};

$databaseConnection = new DatabaseConnection();
$pdo = $databaseConnection->getConnection();

$usuarioController = new UsuarioController($pdo);

if (isset($_POST['cpf'])) {
    // Verificar se já existe um usuário com esse cpf
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM usuarios WHERE cpf = ?');
    $stmt->execute([$_POST['cpf']]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo '<script>alert("Já existe um usuário com esse cpf cadastrado.")</script>';
        
    } else {
        // Se não houver erro, proceder com a criação do usuário
        $usuarioController->criarUsuario($_POST['nome_completo'], $_POST['data_nascimento'], $_POST['email'], $_POST['telefone'], $_POST['cpf'], $_POST['usuario'], $_POST['senha'], $_POST['nivel_permissao']);
        echo '<script>alert("Registro realizado com sucesso!");</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>registro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/cadastroUsuario.css">
</head>

<body>

    <div class="principal">

            <form id="formularioRegistro" method="POST">
                <h2>Registre-se</h2>
                <input type="text" name="nome_completo" placeholder="Nome Completo" required>
                <input type="date" name="data_nascimento" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="tel" name="telefone" placeholder="Telefone" required>
                <input type="text" name="cpf" placeholder="CPF sem traços ou pontos" required>
                <input type="text" name="usuario" placeholder="Usuário" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <input type="hidden" name="nivel_permissao" value="2">
               
                <button type="submit">
                    Registrar
                </button>

                <a id="botaoLogar" href="../../../index.php">
                    Logue na sua conta
                </a>
            </form>


        </div>
    </div>
</body>

</html>