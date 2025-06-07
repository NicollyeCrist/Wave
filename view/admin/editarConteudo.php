<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Conteúdo - MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/editarConteudoAdmin.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; ?>
    
    <div class="container">
        <div class="form-container">
            <h1>Editar Conteúdo</h1>
            
            <?php if (isset($_SESSION['mensagem'])): ?>
                <div class="mensagem <?= $_SESSION['tipo_mensagem'] ?>">
                    <?= htmlspecialchars($_SESSION['mensagem']) ?>
                </div>
                <?php 
                unset($_SESSION['mensagem']);
                unset($_SESSION['tipo_mensagem']);
                ?>
            <?php endif; ?>

            <form action="/mesominds/admin/conteudos/atualizar" method="post" class="form">
                <input type="hidden" name="id" value="<?= $conteudo->getId() ?>">
                
                <div class="form-group">
                    <label for="titulo">Título do Conteúdo:</label>
                    <input type="text" id="titulo" name="titulo" required 
                           value="<?= htmlspecialchars($conteudo->getTitulo()) ?>" 
                           placeholder="Ex: Teorema de Pitágoras">
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="4" 
                              placeholder="Descreva o conteúdo..."><?= htmlspecialchars($conteudo->getDescricao()) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="id_disciplina">Disciplina:</label>
                    <select id="id_disciplina" name="id_disciplina" required>
                        <option value="">Selecione uma disciplina</option>
                        <?php foreach ($disciplinas as $disciplina): ?>
                            <option value="<?= $disciplina['id'] ?>" 
                                    <?= ($conteudo->getIdDisciplina() == $disciplina['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($disciplina['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Links de Conteúdo:</label>
                    <div id="links-container">
                        <?php 
                        $links = $conteudo->getLinksArray();
                        if (!empty($links)): 
                            foreach ($links as $index => $link): 
                        ?>
                            <div class="link-group">
                                <input type="text" name="link_titulo[]" 
                                       placeholder="Título do link" 
                                       value="<?= htmlspecialchars($link['titulo']) ?>"
                                       class="link-titulo">
                                <input type="url" name="link_url[]" 
                                       placeholder="https://exemplo.com" 
                                       value="<?= htmlspecialchars($link['url']) ?>"
                                       class="link-url">
                                <button type="button" onclick="removeLink(this)" class="btn-remove">Remover</button>
                            </div>
                        <?php 
                            endforeach; 
                        else: 
                        ?>
                            <div class="link-group">
                                <input type="text" name="link_titulo[]" placeholder="Título do link" class="link-titulo">
                                <input type="url" name="link_url[]" placeholder="https://exemplo.com" class="link-url">
                                <button type="button" onclick="removeLink(this)" class="btn-remove">Remover</button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="button" onclick="addLink()" class="btn-add">Adicionar Link</button>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Atualizar Conteúdo</button>
                    <a href="/mesominds/conteudos" class="btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addLink() {
            const container = document.getElementById('links-container');
            const linkGroup = document.createElement('div');
            linkGroup.className = 'link-group';
            linkGroup.innerHTML = `
                <input type="text" name="link_titulo[]" placeholder="Título do link" class="link-titulo">
                <input type="url" name="link_url[]" placeholder="https://exemplo.com" class="link-url">
                <button type="button" onclick="removeLink(this)" class="btn-remove">Remover</button>
            `;
            container.appendChild(linkGroup);
        }

        function removeLink(button) {
            const linkGroup = button.parentNode;
            linkGroup.remove();
        }
    </script>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>
