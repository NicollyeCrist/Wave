<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Conteúdo - MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/turmas.css">
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

    <style>
        .form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
        }

        .form {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #2196F3;
            box-shadow: 0 0 0 2px rgba(33, 150, 243, 0.2);
        }

        .link-group {
            display: grid;
            grid-template-columns: 1fr 2fr auto;
            gap: 0.5rem;
            align-items: center;
            margin-bottom: 0.5rem;
            padding: 0.5rem;
            background: #f8f9fa;
            border-radius: 4px;
        }

        .link-titulo, .link-url {
            margin-bottom: 0 !important;
        }

        .btn-remove {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .btn-remove:hover {
            background: #c82333;
        }

        .btn-add {
            background: #28a745;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 0.5rem;
        }

        .btn-add:hover {
            background: #218838;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #eee;
        }

        .btn-primary {
            background: #2196F3;
            color: white;
            padding: 0.75rem 2rem;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: #0d8ce8;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            padding: 0.75rem 2rem;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .mensagem {
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 4px;
            border-left: 4px solid;
        }

        .mensagem.success {
            background: #d4edda;
            color: #155724;
            border-color: #28a745;
        }

        .mensagem.error {
            background: #f8d7da;
            color: #721c24;
            border-color: #dc3545;
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 1rem;
                padding: 1rem;
            }

            .link-group {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>

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
