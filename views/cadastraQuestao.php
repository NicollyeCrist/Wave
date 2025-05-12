<?php
require_once '../model/ConteudoDao.php';
$dao = new ConteudoDao();
$conteudos = $dao->readAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Questão</title>
</head>
<body>
  <h1>Cadastro de Questão</h1>
  <form action="../controller/cadastraQuestao.php" method="post">
    <label for="enunciado">Enunciado:</label><br>
    <textarea id="enunciado" name="enunciado" rows="4" cols="50" required></textarea><br><br>

    <label for="idconteudo">Conteúdo:</label><br>
    <select name="idconteudo" id="idconteudo" required>
      <option value="">Selecione</option>
      <?php foreach ($conteudos as $conteudo): ?>
        <option value="<?= $conteudo->getIdConteudo() ?>">
          <?= htmlspecialchars($conteudo->getTitulo()) ?>
        </option>
      <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Cadastrar</button>
  </form>
</body>
</html>
