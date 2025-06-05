<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    header('Location: /mesominds/admin/login');
    exit;
}

$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Questões - Admin</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/admin.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <div class="header-content">
                <h1>📝 Lista de Questões</h1>
                <div class="header-info">
                    <span>Bem-vindo, <?= htmlspecialchars($_SESSION['admin']['nome']) ?>!</span>
                    <a href="/mesominds/admin/dashboard" class="btn-back">← Voltar ao Dashboard</a>
                    <a href="/mesominds/admin/logout" class="btn-logout">Sair</a>
                </div>
            </div>
        </header>

        <?php if ($msg === 'deletada'): ?>
            <div class="admin-message success">
                Questão deletada com sucesso!
            </div>
        <?php elseif ($msg === 'atualizada'): ?>
            <div class="admin-message success">
                Questão atualizada com sucesso!
            </div>
        <?php endif; ?>

        <main class="admin-main">
            <div class="admin-actions">
                <div class="actions-header">
                    <h2>Questões Cadastradas</h2>
                    <a href="/mesominds/questoes/cadastrar" class="btn btn-success">➕ Nova Questão</a>
                </div>

                <?php if (empty($questoes)): ?>
                    <div class="empty-state">
                        <p>Nenhuma questão cadastrada ainda.</p>
                        <a href="/mesominds/questoes/cadastrar" class="btn btn-primary">Cadastrar Primeira Questão</a>
                    </div>
                <?php else: ?>
                    <div class="table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Enunciado</th>
                                    <th>Conteúdo</th>
                                    <th>Nível</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($questoes as $q): ?>
                                    <tr>
                                        <td><?= $q->getId() ?></td>
                                        <td class="enunciado-cell">
                                            <?= htmlspecialchars(substr($q->getEnunciado(), 0, 100)) ?>
                                            <?= strlen($q->getEnunciado()) > 100 ? '...' : '' ?>
                                        </td>
                                        <td><?= htmlspecialchars($mapConteudos[$q->getIdConteudo()] ?? 'N/A') ?></td>
                                        <td>
                                            <span class="nivel-badge nivel-<?= $q->getNivelDificuldade() ?>">
                                                Nível <?= $q->getNivelDificuldade() ?>
                                            </span>
                                        </td>                                        <td class="actions-cell">
                                            <a href="/mesominds/admin/questoes/editar?id=<?= $q->getId() ?>" 
                                               class="btn btn-sm btn-primary" title="Editar">
                                                ✏️ Editar
                                            </a>
                                            <a href="/mesominds/questoes/deletar?id=<?= $q->getId() ?>" 
                                               class="btn btn-sm btn-danger" 
                                               onclick="return confirm('Tem certeza que deseja excluir esta questão?')"
                                               title="Excluir">
                                                🗑️ Excluir
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <style>
        .actions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .table-container {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th,
        .admin-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        .admin-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }

        .admin-table tbody tr:hover {
            background: #f8f9fa;
        }

        .enunciado-cell {
            max-width: 300px;
            line-height: 1.4;
        }

        .nivel-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            color: white;
        }

        .nivel-1 { background: #28a745; }
        .nivel-2 { background: #ffc107; color: #212529; }
        .nivel-3 { background: #dc3545; }

        .actions-cell {
            white-space: nowrap;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.875rem;
            margin-right: 5px;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .empty-state p {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .btn-back:hover {
            background: #5a6268;
        }

        .header-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .actions-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .admin-table {
                font-size: 0.9rem;
            }

            .enunciado-cell {
                max-width: 200px;
            }

            .header-info {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</body>
</html>
