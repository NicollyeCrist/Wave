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
  <script>
    function addAlternative() {
      const container = document.getElementById('alternativesContainer');
      const index = container.querySelectorAll('input[name="alternativas[]"]').length; 
      const div = document.createElement('div');
      div.innerHTML = `
    <label for="alternativa_${index}">Alternativa ${index + 1}:</label>
    <input type="text" name="alternativas[]" id="alternativa_${index}" required>
    <label>
      <input type="radio" name="correta" value="${index}" required> Correta
    </label>
    <br><br>
  `;
      container.appendChild(div);
    }
  </script>
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

    <div id="alternativesContainer">
      <h3>Alternativas</h3>
      <button type="button" onclick="addAlternative()">Adicionar Alternativa</button><br><br>
    </div>

    <button type="submit">Cadastrar</button>
  </form>
</body>

</html>