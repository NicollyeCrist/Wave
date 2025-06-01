<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="../CSS/global.css">
    <link rel="stylesheet" type="text/css" href="../CSS/admin.css">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="admin-container">
        <!-- Header -->
        <header class="admin-header">
            <div class="header-content">
                <h1>Painel Administrativo</h1>
                <div class="header-info">
                    <span>MesoMinds Admin</span>
                    <a href="../view/index.php" class="btn-exit">Sair</a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-grid">
                
                <!-- Questões Card -->
                <div class="admin-card">
                    <div class="card-header">
                        <h2>Gestão de Questões</h2>
                        <span class="card-icon">📝</span>
                    </div>
                    <div class="card-content">
                        <p>Gerencie todas as questões do sistema</p>
                        <div class="card-stats">
                            <span>Total: <strong id="total-questoes">-</strong></span>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="../controller/listarQuestoes.php" class="btn btn-primary">Listar Questões</a>
                        <a href="../controller/exibirCadastroQuestao.php" class="btn btn-success">Nova Questão</a>
                    </div>
                </div>

                <!-- Conteúdos Card -->
                <div class="admin-card">
                    <div class="card-header">
                        <h2>Gestão de Conteúdos</h2>
                        <span class="card-icon">📚</span>
                    </div>
                    <div class="card-content">
                        <p>Organize e gerencie os conteúdos educacionais</p>
                        <div class="card-stats">
                            <span>Total: <strong id="total-conteudos">-</strong></span>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="../view/listarConteudos.php" class="btn btn-primary">Listar Conteúdos</a>
                        <a href="../view/cadastraConteudo.php" class="btn btn-success">Novo Conteúdo</a>
                    </div>
                </div>

                <!-- Simulados Card -->
                <div class="admin-card">
                    <div class="card-header">
                        <h2>Gestão de Simulados</h2>
                        <span class="card-icon">🎯</span>
                    </div>
                    <div class="card-content">
                        <p>Crie e gerencie simulados para os estudantes</p>
                        <div class="card-stats">
                            <span>Total: <strong id="total-simulados">-</strong></span>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="../view/listarSimulados.php" class="btn btn-primary">Listar Simulados</a>
                        <a href="../view/cadastraSimulado.php" class="btn btn-success">Novo Simulado</a>
                    </div>
                </div>

                <!-- Dashboard Stats Card -->
                <div class="admin-card stats-card">
                    <div class="card-header">
                        <h2>Estatísticas Gerais</h2>
                        <span class="card-icon">📊</span>
                    </div>
                    <div class="card-content">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <span class="stat-number" id="total-all-questoes">0</span>
                                <span class="stat-label">Questões</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number" id="total-all-conteudos">0</span>
                                <span class="stat-label">Conteúdos</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number" id="total-all-simulados">0</span>
                                <span class="stat-label">Simulados</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="admin-card">
                    <div class="card-header">
                        <h2>Ações Rápidas</h2>
                        <span class="card-icon">⚡</span>
                    </div>
                    <div class="card-content">
                        <div class="quick-actions">
                            <a href="../controller/exibirCadastroQuestao.php" class="quick-action">
                                <span>➕</span>
                                <span>Adicionar Questão</span>
                            </a>
                            <a href="../view/cadastraConteudo.php" class="quick-action">
                                <span>📖</span>
                                <span>Adicionar Conteúdo</span>
                            </a>
                            <a href="../view/cadastraSimulado.php" class="quick-action">
                                <span>🎯</span>
                                <span>Criar Simulado</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Info Card -->
                <div class="admin-card">
                    <div class="card-header">
                        <h2>Informações do Sistema</h2>
                        <span class="card-icon">ℹ️</span>
                    </div>
                    <div class="card-content">
                        <div class="system-info">
                            <p><strong>Versão:</strong> 1.0.0</p>
                            <p><strong>Última atualização:</strong> <?php echo date('d/m/Y H:i'); ?></p>
                            <p><strong>Status:</strong> <span class="status-active">Ativo</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        // Simular carregamento de estatísticas
        document.addEventListener('DOMContentLoaded', function() {
            // Aqui você pode fazer requisições AJAX para buscar os dados reais
            setTimeout(() => {
                document.getElementById('total-questoes').textContent = '45';
                document.getElementById('total-conteudos').textContent = '12';
                document.getElementById('total-simulados').textContent = '8';
                document.getElementById('total-all-questoes').textContent = '45';
                document.getElementById('total-all-conteudos').textContent = '12';
                document.getElementById('total-all-simulados').textContent = '8';
            }, 500);
        });
    </script>
</body>

</html>