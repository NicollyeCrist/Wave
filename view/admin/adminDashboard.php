<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrativo - MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/admin.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <div class="header-content">
                <h1>🚀 Dashboard Administrativo</h1>
                <div class="header-info">
                    <span>Bem-vindo, <?= htmlspecialchars($_SESSION['admin']['nome']) ?>!</span>
                    <span class="admin-cargo"><?= htmlspecialchars($_SESSION['admin']['cargo']) ?></span>
                    <a href="/mesominds/admin/logout" class="btn-logout">Sair</a>
                </div>
            </div>
        </header>

        <?php if (isset($_SESSION['admin_mensagem'])): ?>
            <div class="admin-message <?= $_SESSION['admin_tipo_mensagem'] ?>">
                <?= htmlspecialchars($_SESSION['admin_mensagem']) ?>
            </div>
            <?php
            unset($_SESSION['admin_mensagem']);
            unset($_SESSION['admin_tipo_mensagem']);
            ?>
        <?php endif; ?>

        <main class="admin-main">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">👥</div>
                    <div class="stat-info">
                        <h3>Usuários</h3>
                        <p class="stat-number"><?= $totalUsuarios ?? 0 ?></p>
                        <span class="stat-label">Total de usuários</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">📚</div>
                    <div class="stat-info">
                        <h3>Disciplinas</h3>
                        <p class="stat-number"><?= $totalDisciplinas ?? 0 ?></p>
                        <span class="stat-label">Disciplinas ativas</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">📖</div>
                    <div class="stat-info">
                        <h3>Conteúdos</h3>
                        <p class="stat-number"><?= $totalConteudos ?? 0 ?></p>
                        <span class="stat-label">Conteúdos criados</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">❓</div>
                    <div class="stat-info">
                        <h3>Questões</h3>
                        <p class="stat-number"><?= $totalQuestoes ?? 0 ?></p>
                        <span class="stat-label">Questões no banco</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">🏫</div>
                    <div class="stat-info">
                        <h3>Turmas</h3>
                        <p class="stat-number"><?= $totalTurmas ?? 0 ?></p>
                        <span class="stat-label">Turmas ativas</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">🔐</div>
                    <div class="stat-info">
                        <h3>Admins</h3>
                        <p class="stat-number"><?= $totalAdmins ?? 0 ?></p>
                        <span class="stat-label">Administradores</span>
                    </div>
                </div>
            </div>

            <div class="admin-actions">
                <h2>🛠️ Ações Administrativas</h2>
                
                <div class="actions-grid">
                    <div class="action-card">
                        <h3>👤 Gerenciar Usuários</h3>
                        <p>Visualizar, editar e gerenciar contas de usuários</p>
                        <div class="card-actions">
                            <a href="/mesominds/usuarios" class="btn btn-primary">Ver Usuários</a>
                        </div>
                    </div>

                    <div class="action-card">
                        <h3>📚 Gerenciar Conteúdos</h3>
                        <p>Criar, editar e organizar conteúdos educacionais</p>
                        <div class="card-actions">                            <a href="/mesominds/admin/conteudos" class="btn btn-primary">Ver Conteúdos</a>
                            <a href="/mesominds/admin/conteudos/cadastrar" class="btn btn-success">Novo Conteúdo</a>
                        </div>
                    </div>

                    <div class="action-card">
                        <h3>❓ Gerenciar Questões</h3>
                        <p>Criar e organizar questões para simulados</p>
                        <div class="card-actions">
                            <a href="/mesominds/questoes" class="btn btn-primary">Ver Questões</a>
                            <a href="/mesominds/questoes/cadastrar" class="btn btn-success">Nova Questão</a>
                        </div>
                    </div>

                    <div class="action-card">
                        <h3>🏫 Gerenciar Turmas</h3>
                        <p>Criar e administrar turmas de alunos</p>
                        <div class="card-actions">
                            <a href="/mesominds/turmas" class="btn btn-primary">Ver Turmas</a>
                            <a href="/mesominds/turmas/criar" class="btn btn-success">Nova Turma</a>
                        </div>
                    </div>

                    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']['cargo'] === 'Super Administrador'): ?>
                    <div class="action-card super-admin">
                        <h3>🔐 Gerenciar Admins</h3>
                        <p>Cadastrar e gerenciar administradores do sistema</p>
                        <div class="card-actions">
                            <a href="/mesominds/admin/cadastrar" class="btn btn-danger">Novo Admin</a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="action-card">
                        <h3>📊 Relatórios</h3>
                        <p>Visualizar estatísticas e relatórios do sistema</p>
                        <div class="card-actions">
                            <a href="/mesominds/admin/relatorios" class="btn btn-info">Ver Relatórios</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 50%;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #dc3545;
            margin: 5px 0;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .action-card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .action-card.super-admin {
            border-left: 4px solid #dc3545;
        }
        
        .card-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .admin-message {
            margin: 20px;
            padding: 15px;
            border-radius: 4px;
            text-align: center;
        }
        
        .admin-message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .admin-message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .header-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .admin-cargo {
            background: #dc3545;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }
        
        .btn-logout {
            background: #6c757d;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        
        .btn-logout:hover {
            background: #5a6268;
        }
        
        @media (max-width: 768px) {
            .header-info {
                flex-direction: column;
                align-items: flex-end;
                gap: 10px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html>
