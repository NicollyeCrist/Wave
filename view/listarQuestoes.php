<?php
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Questões</title>
    <link rel="stylesheet" href="../CSS/global.css">
</head>
<body>
    <h1>Lista de Questões</h1>
    <?php if ($msg === 'deletada'): ?>
        <p style="color: green;">Questão deletada com sucesso.</p>
    <?php elseif ($msg === 'atualizada'): ?>
        <p style="color: green;">Questão atualizada com sucesso.</p>
    <?php endif; ?>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Enunciado</th>
            <th>Conteúdo</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($questoes as $q): ?>
            <tr>
                <td><?php echo $q->getIdQuestao(); ?></td>
                <td><?php echo htmlspecialchars($q->getEnunciado()); ?></td>
                <td><?php echo htmlspecialchars($mapConteudos[$q->getIdConteudo()] ?? ''); ?></td>
                <td>
                    <a href="../controller/editarQuestao.php?id=<?php echo $q->getIdQuestao(); ?>">Editar</a> |
                    <a href="../controller/deletaQuestao.php?id=<?php echo $q->getIdQuestao(); ?>" onclick="return confirm('Deseja excluir esta questão?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p><a href="cadastraQuestao.php">Cadastrar Nova Questão</a></p>
</body>
</html>
