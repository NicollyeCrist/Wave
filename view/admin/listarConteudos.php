<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Conteúdos - Admin MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/admin.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/listaConteudoAdmin.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <div class="header-content">
                <h1>Gerenciar Conteúdos</h1>
                <div class="header-actions">
                    <a href="/mesominds/admin/conteudos/cadastrar" class="btn btn-primary">+ Novo Conteúdo</a>
                    <a href="/mesominds/admin/dashboard" class="btn btn-secondary">← Dashboard</a>
                </div>
            </div>
        </header>

        <?php if (isset($_SESSION['admin_mensagem'])): ?>
            <div class="alert alert-<?= $_SESSION['admin_tipo_mensagem'] ?? 'info' ?>">
                <?= htmlspecialchars($_SESSION['admin_mensagem']) ?>
            </div>
            <?php 
            unset($_SESSION['admin_mensagem']);
            unset($_SESSION['admin_tipo_mensagem']);
            ?>
        <?php endif; ?>

        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-number"><?= $countAll ?></div>
                <div class="stat-label">Total de Conteúdos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $totalDisciplinas ?></div>
                <div class="stat-label">Disciplinas Ativas</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($conteudos) ?></div>
                <div class="stat-label">Conteúdos Exibidos</div>
            </div>
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
                    <a href="/mesominds/admin/conteudos" class="btn btn-secondary">Limpar Filtro</a>
                <?php endif; ?>
            </form>
        </div>

        <?php if ($disciplinaSelecionada): ?>
            <div class="disciplina-info">
                <h3><?= htmlspecialchars($disciplinaSelecionada['nome']) ?></h3>
                <p><?= htmlspecialchars($disciplinaSelecionada['descricao']) ?></p>
            </div>
        <?php endif; ?>

        <div class="content-table">
            <div class="table-header">
                <h3>Lista de Conteúdos</h3>
            </div>
            
            <?php if (empty($conteudos)): ?>
                <div class="empty-state">
                    <h3>Nenhum conteúdo encontrado</h3>
                    <p>
                        <?php if ($idDisciplina): ?>
                            Não há conteúdos cadastrados para esta disciplina.
                        <?php else: ?>
                            Ainda não há conteúdos cadastrados no sistema.
                        <?php endif; ?>
                    </p>
                    <a href="/mesominds/admin/conteudos/cadastrar" class="btn btn-primary">Cadastrar Primeiro Conteúdo</a>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Disciplina</th>
                            <th>Descrição</th>
                            <th>Links</th>
                            <th>Criado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($conteudos as $conteudo): ?>
                            <tr>
                                <td><?= $conteudo->getId() ?></td>
                                <td><strong><?= htmlspecialchars($conteudo->getTitulo()) ?></strong></td>
                                <td>
                                    <span class="disciplina-badge">
                                        <?= htmlspecialchars($conteudo->disciplinaNome ?? 'N/A') ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="content-description">
                                        <?= htmlspecialchars($conteudo->getDescricao() ?: 'Sem descrição') ?>
                                    </div>
                                </td>
                                <td>
                                    <?php 
                                    $links = $conteudo->getLinksArray();
                                    if (!empty($links)): 
                                    ?>
                                        <span class="links-count"><?= count($links) ?> link(s)</span>
                                    <?php else: ?>
                                        <span style="color: #999;">Nenhum link</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= $conteudo->getCreatedAt() ? date('d/m/Y H:i', strtotime($conteudo->getCreatedAt())) : 'N/A' ?>
                                </td>
                                <td>
                                    <div class="action-buttons">                                        <a href="/mesominds/admin/conteudos/editar?id=<?= $conteudo->getId() ?>" 
                                           class="btn btn-edit">
                                            ✏️ Editar
                                        </a>
                                        <form method="post" action="/mesominds/admin/conteudos/deletar" style="display: inline;">
                                            <input type="hidden" name="id" value="<?= $conteudo->getId() ?>">
                                            <button type="submit" class="btn btn-delete"
                                                    onclick="return confirm('Tem certeza que deseja deletar o conteúdo \'<?= htmlspecialchars($conteudo->getTitulo()) ?>\'?')">
                                                🗑️ Deletar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <style>
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            border: 1px solid transparent;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }
    </style>
</body>
</html>
