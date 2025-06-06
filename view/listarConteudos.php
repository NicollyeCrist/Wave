<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conteúdos - MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/listaConteudo.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">

</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; ?>

    <main class="main-content">
        <div class="filter-section">
            <form method="GET" class="filter-form">
                <label for="disciplina">Filtrar por disciplina:</label>
                <select name="disciplina" id="disciplina" onchange="this.form.submit()">
                    <option value="">Todas as disciplinas</option>
                    <?php foreach ($disciplinas as $disciplina): ?>
                        <option value="<?= $disciplina['id'] ?>" <?= ($idDisciplina == $disciplina['id']) ? 'selected' : '' ?>>
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
                    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo_usuario'] === 'professor'): ?>
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
                                            <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" rel="noopener noreferrer">
                                                <?= htmlspecialchars($link['titulo']) ?>
                                                <span class="external-link">↗</span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>