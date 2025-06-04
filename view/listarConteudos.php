<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conteúdos - MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/turmas.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; ?>
    
    <div class="container">
        <div class="header-section">
            <h1>Conteúdos de Matemática</h1>
            
            <?php if ($_SESSION['usuario']['tipo_usuario'] === 'professor'): ?>
                <a href="/mesominds/conteudos/cadastrar" class="btn-primary">Cadastrar Novo Conteúdo</a>
            <?php endif; ?>
        </div>

        <div class="filter-section">
            <form method="GET" class="filter-form">
                <label for="disciplina">Filtrar por disciplina:</label>
                <select name="disciplina" id="disciplina" onchange="this.form.submit()">
                    <option value="">Todas as disciplinas</option>
                    <?php foreach ($disciplinas as $disciplina): ?>
                        <option value="<?= $disciplina['id'] ?>" 
                                <?= ($idDisciplina == $disciplina['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($disciplina['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if ($idDisciplina): ?>
                    <a href="/mesominds/conteudos" class="btn-secondary">Limpar Filtro</a>
                <?php endif; ?>
            </form>
        </div>

        <?php if ($disciplinaSelecionada): ?>
            <div class="disciplina-info">
                <h2><?= htmlspecialchars($disciplinaSelecionada['nome']) ?></h2>
                <p><?= htmlspecialchars($disciplinaSelecionada['descricao']) ?></p>
            </div>
        <?php endif; ?>

        <div class="conteudos-grid">
            <?php if (empty($conteudos)): ?>
                <div class="empty-state">
                    <h3>Nenhum conteúdo encontrado</h3>
                    <p>
                        <?php if ($idDisciplina): ?>
                            Não há conteúdos cadastrados para esta disciplina.
                        <?php else: ?>
                            Ainda não há conteúdos cadastrados.
                        <?php endif; ?>
                    </p>
                    <?php if ($_SESSION['usuario']['tipo_usuario'] === 'professor'): ?>
                        <a href="/mesominds/conteudos/cadastrar" class="btn-primary">Cadastrar Primeiro Conteúdo</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <?php foreach ($conteudos as $conteudo): ?>
                    <div class="conteudo-card">
                        <div class="card-header">
                            <h3><?= htmlspecialchars($conteudo->getTitulo()) ?></h3>
                            <span class="disciplina-badge"><?= htmlspecialchars($conteudo->disciplinaNome) ?></span>
                        </div>
                        
                        <?php if ($conteudo->getDescricao()): ?>
                            <div class="card-description">
                                <p><?= htmlspecialchars($conteudo->getDescricao()) ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php 
                        $links = $conteudo->getLinksArray();
                        if (!empty($links)): 
                        ?>
                            <div class="card-links">
                                <h4>Materiais de Estudo:</h4>
                                <ul>
                                    <?php foreach ($links as $link): ?>
                                        <li>
                                            <a href="<?= htmlspecialchars($link['url']) ?>" 
                                               target="_blank" 
                                               rel="noopener noreferrer">
                                                <?= htmlspecialchars($link['titulo']) ?>
                                                <span class="external-link">↗</span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                          <div class="card-actions">
                            <a href="/mesominds/questoes?conteudo=<?= $conteudo->getId() ?>" class="btn-secondary">
                                Ver Questões
                            </a>
                            <?php if ($_SESSION['usuario']['tipo_usuario'] === 'professor'): ?>
                                <a href="/mesominds/conteudos/editar?id=<?= $conteudo->getId() ?>" class="btn-edit">
                                    Editar
                                </a>
                                <form method="post" action="/mesominds/conteudos/deletar" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $conteudo->getId() ?>">
                                    <button type="submit" class="btn-delete" 
                                            onclick="return confirm('Tem certeza que deseja deletar este conteúdo?')">
                                        Deletar
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <style>
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .filter-section {
            margin-bottom: 2rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .filter-form {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-form select {
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
        }

        .disciplina-info {
            margin-bottom: 2rem;
            padding: 1rem;
            background: #e3f2fd;
            border-radius: 8px;
            border-left: 4px solid #2196F3;
        }

        .conteudos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .conteudo-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .conteudo-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            gap: 1rem;
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.25rem;
            color: #333;
            line-height: 1.3;
        }

        .disciplina-badge {
            background: #2196F3;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .card-description {
            margin-bottom: 1rem;
        }

        .card-description p {
            margin: 0;
            color: #666;
            line-height: 1.5;
        }

        .card-links {
            margin-bottom: 1rem;
        }

        .card-links h4 {
            margin: 0 0 0.5rem 0;
            font-size: 1rem;
            color: #333;
        }

        .card-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .card-links li {
            margin-bottom: 0.5rem;
        }

        .card-links a {
            color: #2196F3;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .card-links a:hover {
            background: #f0f8ff;
            text-decoration: underline;
        }

        .external-link {
            font-size: 0.875rem;
            opacity: 0.7;
        }

        .card-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-edit {
            background: #ff9800;
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.875rem;
            transition: background 0.2s;
        }        .btn-edit:hover {
            background: #f57c00;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            font-size: 0.875rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-delete:hover {
            background: #c82333;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #ddd;
        }

        .empty-state h3 {
            margin: 0 0 1rem 0;
            color: #666;
        }

        .empty-state p {
            margin: 0 0 1.5rem 0;
            color: #888;
        }

        @media (max-width: 768px) {
            .header-section {
                flex-direction: column;
                align-items: stretch;
            }

            .header-section h1 {
                text-align: center;
            }

            .conteudos-grid {
                grid-template-columns: 1fr;
            }

            .card-header {
                flex-direction: column;
                align-items: stretch;
            }

            .card-actions {
                justify-content: center;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>