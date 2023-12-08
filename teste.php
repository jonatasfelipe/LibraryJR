<?php
session_start();
require_once 'C:/xampp/htdocs/biblioteca-virtual/src/config/config.php';
require_once 'C:/xampp/htdocs/biblioteca-virtual/src/index/app/Controllers/LoginController.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/estilo.css">
</head>

<body>
    <div class="container">

        <div class="esquerda"></div>

        <div class="direita"></div>
    </div>

    <?php
    $usuario = new LoginController($pdo);

    if (isset($_SESSION['id'])) {
        $result = $usuario->listarLoginUsuario($_SESSION['id']);
    ?>

        <div class="container2">

            <div class="esquerda2">
                <nav>
                    <ul>
                        <li>👤
                            <?php echo $result[0]['nome']; ?>
                        </li>
                        <li><a href="Livros.php">📚 Livro</a></li>
                        <li>🛒 Emprestimos</li>
                        <li>⏳ Histórico</li>
                        <?php if ($_SESSION["permissao"] == '1') {
                            echo " <li ><a href ='adm.php'>adm do site</a></li>";
                        } ?>
                </nav>
            </div>

            <div class="direita2">
                <?php
                require_once 'c:/xampp/htdocs/biblioteca-virtual/src/index/app/Controllers/LoginController.php';
                require_once 'c:/xampp/htdocs/biblioteca-virtual/src/index/app/Controllers/LivrosController.php';
                require_once 'c:/xampp/htdocs/biblioteca-virtual/src/index/app/Controllers/emprestimosController.php';

                /** ---------------------------INÍCIO SEÇÃO LOGIN-------------------------------- */
                $LoginController = new LoginController($pdo);

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar_login'])) {

                    if (
                        isset($_POST['nome']) &&
                        isset($_POST['email']) &&
                        isset($_POST['senha'])
                    ) {
                        $LoginController->CriarLogin($_POST['nome'], $_POST['email'], $_POST['senha']);
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar_login'])) {

                    if (
                        isset($_POST['login_id']) &&
                        isset($_POST['atualizar_nome']) &&
                        isset($_POST['atualizar_email']) &&
                        isset($_POST['atualizar_senha'])
                    ) {
                        $LoginController->atualizarLogin(
                            $_POST['login_id'],
                            $_POST['atualizar_nome'],
                            $_POST['atualizar_email'],
                            $_POST['atualizar_senha']
                        );
                    }
                }

                if (isset($_POST['excluir_login_id'])) {
                    $LoginController->excluirLogin($_POST['excluir_login_id']);
                }

                $Logins = $LoginController->listarLogins();

                $LoginController->exibirListaLogins();
                ?>

                <h1>Logins</h1>
                <form method="post">
                    <input type="hidden" name="cadastrar_login" value="cadastrar_login">
                    <input type="text" name="nome" placeholder="Nome">
                    <input type="text" name="email" placeholder="Email">
                    <input type="text" name="senha" placeholder="senha">
                    <button type="submit">Adicionar Login</button>
                </form>


                <h2>Atualizar Login</h2>
                <form method="post">
                    <select name="login_id">
                        <?php foreach ($Logins as $login) : ?>
                            <option value="<?php echo $login['id_usuario']; ?>">
                                <?php echo $login['id_usuario']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="atualizar_login" value="atualizar_login">
                    <input type="text" name="atualizar_nome" placeholder="Novo nome">
                    <input type="text" name="atualizar_email" placeholder="Novo email">
                    <input type="text" name="atualizar_senha" placeholder="Nova senha">
                    <button type="submit">Atualizar Login</button>
                </form>

                <h2>Excluir Login</h2>
                <form method="post">
                    <select name="excluir_login_id">
                        <?php foreach ($Logins as $login) : ?>
                            <option value="<?php echo $login['id_usuario']; ?>">
                                <?php echo $login['nome']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Excluir Login</button>
                </form>
                <?php
                /** -------------------------------FIM SEÇÃO LOGIN-------------------------------- */




                /** -------------------------------SEÇÃO LIVROS-------------------------------- */
                $livrosController = new LivrosController($pdo);

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar_livro'])) {

                    if (
                        isset($_POST['nome']) &&
                        isset($_POST['categoria']) &&
                        isset($_POST['imagem'])
                    ) {
                        $livrosController->criarLivros(
                            $_POST['nome'],
                            $_POST['categoria'],
                            $_POST['imagem']
                        );
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar_livro'])) {

                    if (
                        isset($_POST['atualizar_nome']) &&
                        isset($_POST['atualizar_categoria']) &&
                        isset($_POST['atualizar_imagem']) &&
                        isset($_POST['livro_id'])
                    ) {
                        $livrosController->atualizarlivros(
                            $_POST['atualizar_nome'],
                            $_POST['atualizar_categoria'],
                            $_POST['atualizar_imagem'],
                            $_POST['livro_id']
                        );
                    }
                }


                $livros = $livrosController->listarLivros();

                if (isset($_POST['excluir_livro_id'])) {
                    $livrosController->excluirlivros($_POST['excluir_livro_id']);
                }

                ?>

                <?php
                $livrosController->exibirListaLivros();
                ?>

                <h1>Livros</h1>
                <form method="post">
                    <input type="hidden" name="cadastrar_livro" value="cadastrar_livro">
                    <input type="text" name="nome" placeholder="Nome">
                    <input type="text" name="categoria" placeholder="categoria">
                    <input type="text" name="imagem" placeholder="imagem">

                    <button type="submit">Adicionar Livros</button>
                </form>

                <h2>Atualizar Livros</h2>
                <form method="post">
                    <input type="hidden" name="atualizar_livro" value="atualizar_livro">
                    <select name="livro_id">
                        <?php foreach ($livros as $livro) : ?>
                            <option value="<?php echo $livro['livro_id']; ?>">
                                <?php echo $livro['livro_id']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" name="atualizar_nome" placeholder="Novo Nome">
                    <input type="text" name="atualizar_categoria" placeholder="Nova categoria">
                    <input type="text" name="atualizar_imagem" placeholder="Nova imagem">
                    <button type="submit">Atualizar Livros</button>
                </form>

                <h2>Excluir Livros</h2>
                <form method="post">
                    <select name="excluir_livro_id">
                        <?php foreach ($livros as $livro) : ?>
                            <option value="<?php echo $livro['livro_id']; ?>">
                                <?php echo $livro['nome']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Excluir Livros</button>
                </form>

            <?php
            /** ---------------------------FIM DA SEÇÃO LIVROS-------------------------------- */



            /** ---------------------------SEÇÃO EMPRESTIMOS-------------------------------- */

            $emprestimoController = new EmprestimosController($pdo);

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['criar_emprestimo'])) {

                if (
                    isset($_POST['id_livro']) &&
                    isset($_POST['id_usuario']) &&
                    isset($_POST['data_emprestimo'])
                ) {
                    $emprestimoController->criarEmprestimos($_POST['id_livro'], $_POST['id_usuario'], $_POST['data_emprestimo']);
                }
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar_emprestimo'])) {

                if (
                    isset($_POST['id_emprestimo']) &&
                    isset($_POST['atualizar_id_livro']) &&
                    isset($_POST['atualizar_id_usuario']) &&
                    isset($_POST['atualizar_data_emprestimo'])
                ) {
                    $resultado = $emprestimoController->atualizarEmprestimos(
                        $_POST['id_emprestimo'],
                        $_POST['atualizar_id_livro'],
                        $_POST['atualizar_id_usuario'],
                        $_POST['atualizar_data_emprestimo'],
                    );
                    
                }
    
            }
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['excluir_emprestimo'])) {
                if (isset($_POST['id_emprestimo'])) {
                    $emprestimoController->excluirEmprestimos($_POST['id_emprestimo']);
                }
            }

            $emprestimos = $emprestimoController->listarEmprestimos();

            $emprestimoController->exibirListaEmprestimos();

            ?>

             <!--Cadastro emprestimo -->
             <h1>emprestimos</h1>
            <form method="post">
                <input type="hidden" name="criar_emprestimo" value="criar_emprestimo">
                <input type="text" name="id_livro" placeholder="id do Livro">
                <input type="text" name="id_usuario" placeholder="Id do usuario">
                <input type="date" name="data_emprestimo" placeholder="data do emprestimo">

                <button type="submit">Adicionar emprestimo</button>
            </form>

            <h2>Atualizar emprestimo</h2>
            <form method="post">
                <input type="hidden" name="atualizar_emprestimo" value="atualizar_emprestimo">
                <select name="id_emprestimo">
                    <?php foreach ($emprestimos as $emprestimo): ?>
                        <option value="<?php echo $emprestimo['id_emprestimo']; ?>">
                            <?php echo $emprestimo['id_emprestimo']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="atualizar_id_livro" placeholder="Novo id do livro ">
                <input type="text" name="atualizar_id_usuario" placeholder="Nova Id do usuario">
                <input type="date" name="atualizar_data_emprestimo" placeholder="Nova data de emprestimo">
                <button type="submit">Atualizar emprestimos</button>
            </form>

            <h2>Excluir emprestimo</h2>
            <form method="post">
            <input type="hidden" name="excluir_emprestimo" value="excluir_emprestimo">
                <select name="id_emprestimo">
                    <?php foreach ($emprestimos as $emprestimo): ?>
                        <option type=hidden value="<?php echo $emprestimo['id_emprestimo']; ?>">
                            <?php echo $emprestimo['id_emprestimo']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Excluir emprestimos</button>
            </form>

        </div>
    </div>
<?php
        } else {
            echo '<script> var resultado = confirm("VOCÊ NÃO POSSUI PERMISSÃO PARA ACESSAR ESTA PÁGINA! \nconfirma o redirecionamento para login.php?");

    if (resultado) {
        window.location.href = "login.php";
    } else {
        alert("Redirecionamento cancelado.");
    }
            </script>';
        }
            ?>

</body>

</html>