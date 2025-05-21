<?php
require_once '../model/SimuladoDao.php';
require_once '../model/dbConnection.php';

$simuladoId = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$simuladoId) {
    echo "Simulado não encontrado.";
    exit;
}

$pdo = DbConnection::getConn();
$stmt = $pdo->prepare('SELECT * FROM simulados WHERE id = ? AND status = "ativo"');
$stmt->execute([$simuladoId]);
$simulado = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$simulado) {
    echo "Simulado não encontrado ou inativo.";
    exit;
}

$stmtQ = $pdo->prepare('SELECT q.idquestao, q.enunciado FROM simulados_questoes sq JOIN questao q ON q.idquestao = sq.questao_id WHERE sq.simulado_id = ? ORDER BY sq.ordem');
$stmtQ->execute([$simuladoId]);
$questoes = $stmtQ->fetchAll(PDO::FETCH_ASSOC);

$alternativas = [];
foreach ($questoes as $q) {
    $stmtA = $pdo->prepare('SELECT idalternativa, texto FROM alternativas WHERE idquestao = ?');
    $stmtA->execute([$q['idquestao']]);
    $alternativas[$q['idquestao']] = $stmtA->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Responder Simulado</title>
    <link rel="stylesheet" type="text/css" href="../CSS/global.css">
</head>
<body>
    <h1><?= htmlspecialchars($simulado['titulo']) ?></h1>
    <form method="post" action="responderSimulado.php?id=<?= $simuladoId ?>">
        <?php foreach ($questoes as $i => $q): ?>
            <div style="margin-bottom:20px;">
                <strong>Questão <?= $i+1 ?>:</strong> <?= htmlspecialchars($q['enunciado']) ?><br>
                <?php foreach ($alternativas[$q['idquestao']] as $alt): ?>
                    <label>
                        <input type="radio" name="respostas[<?= $q['idquestao'] ?>]" value="<?= $alt['idalternativa'] ?>" required>
                        <?= htmlspecialchars($alt['texto']) ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <button type="submit">Enviar Respostas</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['respostas'])) {
        $respostas = $_POST['respostas'];
        $acertos = 0;
        $total = count($questoes);
        foreach ($questoes as $q) {
            $qid = $q['idquestao'];
            $altMarcada = isset($respostas[$qid]) ? $respostas[$qid] : null;
            if ($altMarcada) {
                $stmtC = $pdo->prepare('SELECT correta FROM alternativas WHERE idalternativa = ? AND idquestao = ?');
                $stmtC->execute([$altMarcada, $qid]);
                $correta = $stmtC->fetchColumn();
                if ($correta == 1) $acertos++;
            }
        }
        $nota = $total > 0 ? round(($acertos/$total)*10, 2) : 0;
        echo "<h2>Resultado: $acertos de $total questões corretas. Nota: $nota</h2>";
    }
    ?>
</body>
</html>
