<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de livros</title>
    <link rel="stylesheet" href="../../assets/css/listaLivros.css">

</head>

<body>
    <table border="1px" id="tabelaLivros">
        <tr id="cabecalho">
            <th>ID</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Editora</th>
            <th>Números de Páginas</th>
            <th>Código de Barras</th>
            <th>Livros Disponíveis</th>
        </tr>
        <?php foreach ($livros as $livro) : ?>
            <tr id="conteudo">
                <td><?php echo $livro['id_livro']; ?></td>
                <td><?php echo $livro['titulo']; ?></td>
                <td><?php echo $livro['autor']; ?></td>
                <td><?php echo $livro['editora']; ?></td>
                <td><?php echo $livro['numero_paginas']; ?></td>
                <td><?php echo $livro['codigo_barras']; ?></td>
                <td><?php echo $livro['livros_disponiveis']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>