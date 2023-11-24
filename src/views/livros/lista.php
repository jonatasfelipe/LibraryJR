<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de livros</title>
    <link rel="stylesheet" href="src/assets/css/listaLivros.css">

</head>

<body>
    <div id="tabelaLivros">
        <div id="cabecalho">
            <div>ID</div>
            <div>Titulo</div>
            <div>Autor</div>
            <div>Editora</div>
            <div>Números de Páginas</div>
            <div>Código de Barras</div>
            <div>Livros Disponíveis</div>
        </div>
        <?php foreach ($livros as $livro) : ?>
            <div id="conteudo">
                <div><?php echo $livro['id_livro']; ?></div>
                <div><?php echo $livro['titulo']; ?></div>
                <div><?php echo $livro['autor']; ?></div>
                <div><?php echo $livro['editora']; ?></div>
                <div><?php echo $livro['numero_paginas']; ?></div>
                <div><?php echo $livro['codigo_barras']; ?></div>
                <div><?php echo $livro['livros_disponiveis']; ?></div>
            </div>
        <?php endforeach; ?>
        </table>
</body>

</html>