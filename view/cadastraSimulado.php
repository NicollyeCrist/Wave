<?php
require_once '../model/dbConnection.php';

// Carregar questões para o select
$pdo = DbConnection::getConn();
$questoes = $pdo->query('SELECT idquestao, enunciado FROM questao')->fetchAll(PDO::FETCH_ASSOC);

// Mensagem de feedback
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Simulado</title>
  <link rel="stylesheet" type="text/css" href="../CSS/global.css">
  <link rel="stylesheet" type="text/css" href="../view/partials/footer.css">
  <link rel="stylesheet" type="text/css" href="../view/partials/header.css">
  <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
</head>

<body>
  <h1>Cadastro de Simulado</h1>
  <?php if ($msg): ?>
    <p><?= htmlspecialchars($msg) ?></p>
  <?php endif; ?>
  <form method="post" action="../controller/cadastraSimulado.php">
    <label for="titulo">Título:</label><br>
    <input type="text" name="titulo" id="titulo" required><br><br>

    <label for="descricao">Descrição:</label><br>
    <textarea name="descricao" id="descricao" rows="3"></textarea><br><br>

    <label for="status">Status:</label><br>
    <select name="status" id="status" required>
      <option value="rascunho">Rascunho</option>
      <option value="ativo">Ativo</option>
      <option value="finalizado">Finalizado</option>
    </select><br><br>

    <label for="searchQuestoes">Buscar Questão:</label><br>
    <input type="text" id="searchQuestoes" onkeyup="filterQuestoes()" placeholder="Digite parte do enunciado..."><br><br>

    <label>Selecione as questões do Simulado:</label><br>
    <div id="questoesCheckboxes" style="max-height:200px;overflow-y:auto;border:1px solid #ccc;padding:8px;min-width:300px;">
      <?php foreach ($questoes as $q): ?>
        <div class="questao-item">
          <label>
            <input type="checkbox" name="questoes[]" value="<?= $q['idquestao'] ?>">
            <?= htmlspecialchars($q['enunciado']) ?> (ID: <?= $q['idquestao'] ?>)
          </label>
        </div>
      <?php endforeach; ?>
    </div>
    <br>
    <button type="submit">Cadastrar Simulado</button>
  </form>

  <script>
    function filterQuestoes() {
      var input = document.getElementById('searchQuestoes');
      var filter = input.value.toLowerCase();
      var nodes = document.querySelectorAll('#questoesCheckboxes .questao-item');
      nodes.forEach(function(node) {
        var text = node.textContent.toLowerCase();
        node.style.display = text.indexOf(filter) > -1 ? '' : 'none';
      });
    }
  </script>
</body>

</html>