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
                <td><?php echo $q->getId(); ?></td>
                <td><?php echo htmlspecialchars($q->getEnunciado()); ?></td>
                <td><?php echo htmlspecialchars($mapConteudos[$q->getIdConteudo()] ?? ''); ?></td>
                <td>
                    <a href="/mesominds/questoes/editar?id=<?php echo $q->getId(); ?>">Editar</a> |
                    <a href="/mesominds/questoes/deletar?id=<?php echo $q->getId(); ?>" 
                       onclick="return confirm('Tem certeza que deseja excluir esta questão?')">
                        Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p><a href="/mesominds/questoes/cadastrar">Cadastrar Nova Questão</a></p>
</body>
</html>
