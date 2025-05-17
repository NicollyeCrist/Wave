<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Conteúdo</title>
</head>

<body>
    <h1>Cadastro de Conteúdo</h1>
    <form action="../controller/cadastraConteudo.php" method="post">
        <label for="nome">Nome do Conteúdo:</label><br>
        <input type="text" id="tituloConteudo" name="tituloConteudo" required><br><br>
        <label for="nome">Descrição do Conteúdo:</label><br>
        <input type="text" id="descricao" name="descricao" required><br><br>
        <label for="nome">Link do Conteúdo:</label><br>
        <input type="text" id="linkconteudo" name="linkconteudo"><br><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>

</html>