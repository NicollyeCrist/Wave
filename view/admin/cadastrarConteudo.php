<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Conteúdo - MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; ?>

    <div class="container">
        <div class="form-container">
            <h1>Cadastrar Novo Conteúdo</h1>

            <?php if (isset($_SESSION['mensagem'])): ?>
                <div class="mensagem <?= $_SESSION['tipo_mensagem'] ?>">
                    <?= htmlspecialchars($_SESSION['mensagem']) ?>
                </div>
                <?php
                unset($_SESSION['mensagem']);
                unset($_SESSION['tipo_mensagem']);
                ?>
            <?php endif; ?>

            <form action="/mesominds/admin/conteudos/cadastrar" method="post" class="form">
                <div class="form-group">
                    <label for="titulo">Título do Conteúdo:</label>
                    <input type="text" id="titulo" name="titulo" required placeholder="Ex: Teorema de Pitágoras">
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva o conteúdo..."></textarea>
                </div>
                <div class="form-group">
                    <label for="id_disciplina">Disciplina:</label>

                    <select id="id_disciplina" name="id_disciplina" required>
                        <option value="">Selecione uma disciplina</option>
                        <?php if (isset($disciplinas) && is_array($disciplinas) && count($disciplinas) > 0): ?>
                            <?php foreach ($disciplinas as $disciplina): ?>
                                <option value="<?= $disciplina['id'] ?>">
                                    <?= htmlspecialchars($disciplina['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Nenhuma disciplina encontrada</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Links de Referência:</label>
                    <div id="links-container">
                        <div class="link-group">
                            <input type="text" name="link_titulo[]" placeholder="Título do link" class="link-titulo">
                            <input type="url" name="link_url[]" placeholder="https://exemplo.com" class="link-url">
                            <button type="button" class="btn-remove-link" onclick="removeLink(this)"
                                style="display: none;">Remover</button>
                        </div>
                    </div>
                    <button type="button" id="add-link" class="btn-secondary">Adicionar Link</button>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Cadastrar Conteúdo</button>
                    <a href="/mesominds/conteudos" class="btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        let linkCount = 1;

        document.getElementById('add-link').addEventListener('click', function () {
            const container = document.getElementById('links-container');
            const newLinkGroup = document.createElement('div');
            newLinkGroup.className = 'link-group';
            newLinkGroup.innerHTML = `
                <input type="text" name="link_titulo[]" placeholder="Título do link" class="link-titulo">
                <input type="url" name="link_url[]" placeholder="https://exemplo.com" class="link-url">
                <button type="button" class="btn-remove-link" onclick="removeLink(this)">Remover</button>
            `;
            container.appendChild(newLinkGroup);
            linkCount++;

            if (linkCount > 1) {
                const firstRemoveBtn = container.querySelector('.btn-remove-link');
                if (firstRemoveBtn) {
                    firstRemoveBtn.style.display = 'inline-block';
                }
            }
        });

        function removeLink(button) {
            const linkGroup = button.parentElement;
            linkGroup.remove();
            linkCount--;

            if (linkCount === 1) {
                const remainingRemoveBtn = document.querySelector('.btn-remove-link');
                if (remainingRemoveBtn) {
                    remainingRemoveBtn.style.display = 'none';
                }
            }
        }
    </script>

    <style>
        .link-group {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: center;
        }

        .link-titulo,
        .link-url {
            flex: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-remove-link {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-remove-link:hover {
            background: #c82333;
        }

        .mensagem {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .mensagem.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .mensagem.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .link-group {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>