<?php
require_once '../model/SimuladoDao.php';
require_once '../model/dbConnection.php';
$pdo = DbConnection::getConn();
$stmt = $pdo->prepare('SELECT * FROM simulados WHERE status = "ativo"');
$stmt->execute();
$simulados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulados</title>
    <link rel="stylesheet" type="text/css" href="../CSS/global.css">
</head>

<body>
    <h1>Simulados Ativos</h1>
    <?php if (count($simulados) === 0): ?>
        <p>Nenhum simulado ativo disponível.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($simulados as $s): ?>
                <?php 
                    // Verifica se as chaves existem para evitar notices
                    $titulo = isset($s['titulo']) ? htmlspecialchars($s['titulo']) : 'Título indisponível';
                    $descricao = isset($s['descricao']) ? htmlspecialchars($s['descricao']) : 'Descrição indisponível';
                    $idSimulado = isset($s['id']) ? $s['id'] : null;
                ?>
                <li style="white-space: pre-line;">
                    <strong><?php echo nl2br($titulo); ?></strong> - <?php echo nl2br($descricao); ?>
                    <?php if ($idSimulado): ?>
                        <a href="responderSimulado.php?id=<?php echo urlencode($idSimulado); ?>">Responder</a>
                    <?php else: ?>
                        <span>Link indisponível (ID do simulado não encontrado)</span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>

</html>