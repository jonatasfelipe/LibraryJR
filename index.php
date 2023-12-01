<?php
require_once "vendor/autoload.php";
session_start();

use LibraryJr\config\DatabaseConnection;
use LibraryJr\controllers\UsuarioController;

$databaseConnection = new DatabaseConnection();
$pdo = $databaseConnection->getConnection();

$usuarioController = new UsuarioController($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formulario_enviado = $_POST["formulario_enviado"];

    if ($formulario_enviado == "login") {

        $resultado = $usuarioController->fazerLogin($_POST['usuario'], $_POST['senha']);

        if (count($resultado) > 0) {
            echo "<script>alert('Logado com sucesso!');</script>";
            header('Location: #');
        } else {
            echo "<script>alert('Usuario ou senha inválida!');</script>";
            header('Location: #');
        }
    }

    if ($formulario_enviado == "logout") {
        unset($_SESSION['LOGIN']);
        unset($_SESSION['USUARIO']);
    }
}


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
        <div id="links">
            <a href="#">Início</a>
            <?php
            if (isset($_SESSION['LOGIN'])) {
                if ($_SESSION['LOGIN'] == TRUE) {
                    echo '
                        <div><a href="src/views/livros/livros.php">Livros</a>
                        <a href="#">Autores</a>

                        <a href="#">Contato</a>
                        <a href="#">Sobre Nós</a></div>
                        <div>
                            <form id="formLogout" method="POST">
                                <input type="hidden" name="formulario_enviado" value="logout">
                                <input type="hidden" name="id_usuario" value=' . $_SESSION['USUARIO'][0]['id_usuario'] . '">
                                <button id="buttonLogout" type="submit">Sair</button>
                            </form>
                        </div>';
                }
            }
            ?>

        </div>


        <?php if (!isset($_SESSION['LOGIN']) || $_SESSION['LOGIN'] == FALSE) { ?>

            <div>
                <form id="formLogin" method="POST">
                    <input type="hidden" name="formulario_enviado" value="login">
                    <label for="usuario">Usuário:</label>
                    <input type="text" id="usuario" name="usuario" required>

                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>

                    <button type="submit" id="buttonLogin">Entrar</button>
                </form>
            </div>
        <?php } ?>


    </nav>

    <section>
        <h2>Sobre a Biblioteca</h2>
        <p>Nome da Biblioteca: Biblioteca Virtual</p>
        <p>Endereço: Rua da Biblioteca, 123</p>
        <p>Telefone: (123) 456-7890</p>
    </section>

    <footer>
        <p>&copy; 2023 LibraryJr. Todos os direitos reservados.</p>
    </footer>

</body>

</html>