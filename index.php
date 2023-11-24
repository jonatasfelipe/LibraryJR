<?php
    require_once "vendor/autoload.php";

session_start();

$_SESSION['LOGIN'] = TRUE;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual</title>
    <link rel="stylesheet" href="src/assets/css/index.css">
</head>

<body>

    <header>
        <h1>LibraryJr</h1>
    </header>

    <nav>
        <div style="width: 100%; display:flex; justify-content:space-around;">
            <a href="#">Início</a>
            <?php
                if($_SESSION['LOGIN'] == TRUE) {
                    echo '
                    <a href="src/views/livros/livros.php">Livros</a>
                    <a href="#">Autores</a>';
                }
            ?>
            <a href="#">Contato</a>
            <a href="#">Sobre Nós</a>
        </div>

        <div>
            <form>
                <label for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>

                <button type="submit">Entrar</button>
            </form>
        </div>

    </nav>

    <section>
        <h2>Sobre a Biblioteca</h2>
        <p>Nome da Biblioteca: Biblioteca Virtual</p>
        <p>Endereço: Rua da Biblioteca, 123</p>
        <p>Telefone: (123) 456-7890</p>

        <h2>Login</h2>

    </section>

    <footer>
        <p>&copy; 2023 LibraryJr. Todos os direitos reservados.</p>
    </footer>

</body>

</html>

<?php

require_once "vendor/autoload.php";

use LibraryJr\config\DatabaseConnection;
use LibraryJr\controllers\LivroController;

$databaseConnection = new DatabaseConnection();
$pdo = $databaseConnection->getConnection();

$competidores = new LivroController($pdo);

$competidores->exibirListaLivros();

?>