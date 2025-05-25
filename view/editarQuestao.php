<?php
require_once __DIR__ . '/../model/ConteudoDao.php';

$conteudoDao = new ConteudoDao();
$conteudos = $conteudoDao->readAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Questão</title>
    <link rel="stylesheet" href="../CSS/global.css">
</head>
<body>
    <h1>Editar Questão #<?php echo $questao->getIdQuestao(); ?></h1>
    <form action="../controller/atualizaQuestao.php" method="post">
        <input type="hidden" name="idquestao" value="<?php echo $questao->getIdQuestao(); ?>">

        <label for="enunciado">Enunciado:</label><br>
        <textarea id="enunciado" name="enunciado" rows="4" cols="50" required><?php echo htmlspecialchars($questao->getEnunciado()); ?></textarea><br><br>

        <label for="idconteudo">Conteúdo:</label><br>
        <select id="idconteudo" name="idconteudo" required>
            <option value="">Selecione</option>
            <?php foreach ($conteudos as $c): ?>
                <option value="<?php echo $c->getIdConteudo(); ?>" <?php echo $c->getIdConteudo() == $questao->getIdConteudo() ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($c->getTitulo()); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Atualizar Questão</button>
        <a href="listarQuestoes.php">Cancelar</a>
    </form>
</body>
</html>
