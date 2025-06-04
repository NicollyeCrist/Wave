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
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .admin-header {
            background: linear-gradient(135deg, #2196F3, #1976D2);
            color: white;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header-content h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 600;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: #28a745;
            color: white;
        }

        .btn-primary:hover {
            background: #218838;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
        }

        .btn-secondary:hover {
            background: rgba(255,255,255,0.3);
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #2196F3;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        .filter-section {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
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
            min-width: 200px;
        }

        .content-table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .table-header {
            background: #f8f9fa;
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .table-header h3 {
            margin: 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .disciplina-badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-edit {
            background: #ffc107;
            color: #212529;
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }

        .btn-edit:hover {
            background: #e0a800;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }

        .btn-delete:hover {
            background: #c82333;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .empty-state h3 {
            margin-bottom: 1rem;
            color: #333;
        }

        .disciplina-info {
            background: #e3f2fd;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #2196F3;
            margin-bottom: 2rem;
        }

        .disciplina-info h3 {
            margin: 0 0 0.5rem 0;
            color: #1976d2;
        }

        .content-description {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .links-count {
            background: #28a745;
            color: white;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.75rem;
        }

        @media (max-width: 768px) {
            .admin-container {
                padding: 1rem;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-form select {
                min-width: auto;
            }

            table {
                font-size: 0.9rem;
            }

            th, td {
                padding: 0.75rem 0.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
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
