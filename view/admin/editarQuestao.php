<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Questão</title>
    <link rel="stylesheet" href="../CSS/global.css">
    <script>
        function addAlternative() {
            const container = document.getElementById('alternativesContainer');
            const existingCount = container.querySelectorAll('input[type="text"]').length;
            const index = 'new_' + existingCount;
            const div = document.createElement('div');
            div.innerHTML = `
            <label for="alternativa_${index}">Nova Alternativa:</label>
            <input type="text" name="alternativas[${index}]" id="alternativa_${index}" required>
            <label>
                <input type="radio" name="correta" value="${index}" required> Correta
            </label>
        `;
            container.appendChild(div);
            document.getElementById(`alternativa_${index}`).focus();
        }
    </script>
</head>

<body>
    <h1>Editar Questão #<?php echo $questao->getId(); ?></h1>
    <form action="/mesominds/admin/questoes/atualizar" method="post">
        <input type="hidden" name="id" value="<?= $questao->getId() ?>">

        <label for="enunciado">Enunciado:</label><br>
        <textarea id="enunciado" name="enunciado" rows="4" cols="50"
            required><?= htmlspecialchars($questao->getEnunciado()) ?></textarea><br><br>

        <label for="id_conteudo">Conteúdo:</label><br>
        <select name="id_conteudo" id="id_conteudo" required>
            <option value="">Selecione</option>
            <?php foreach ($conteudos as $conteudo): ?>
                <option value="<?= $conteudo->getId() ?>" <?= $conteudo->getId() == $questao->getIdConteudo() ? 'selected' : '' ?>>
                    <?= htmlspecialchars($conteudo->getTitulo()) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        <button type="button" onclick="addAlternative()">Adicionar Nova Alternativa</button>
        <div id="alternativesContainer">
            <h3>Alternativas</h3>
            <?php foreach ($alternativas as $index => $alt): ?>
                <div>
                    <label for="alternativa_<?= $index ?>">Alternativa <?= $index + 1 ?>:</label>
                    <input type="text" name="alternativas[<?= $alt['id'] ?>]" 
                           id="alternativa_<?= $index ?>" 
                           value="<?= htmlspecialchars($alt['texto']) ?>" required>
                    <label>
                        <input type="radio" name="correta" 
                               value="<?= $alt['id'] ?>" 
                               <?= (bool) $alt['correta'] ? 'checked' : '' ?> required> Correta
                    </label>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="submit">Atualizar Questão</button>
        <a href="/mesominds/admin/questoes">Cancelar</a>
    </form>
</body>

</html>