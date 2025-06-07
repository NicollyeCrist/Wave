<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Em Breve - MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/emBreve.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; ?>
    <main class="em-breve-container">
        <div class="em-breve-content">
            <div class="em-breve-icon"></div>
            <h1 class="em-breve-title">Função em Desenvolvimento</h1>
            <p class="em-breve-subtitle">Esta funcionalidade está sendo desenvolvida e estará disponível em breve!</p>

            <div class="funcionalidades-em-breve">
                <h3>Próximas funcionalidades:</h3>
                <ul>
                    <li>Sistema de Simulados</li>
                    <li>Questões ENEM e correções detalhadas</li>
                    <li>Modo Rápido</li>
                    <li>Notificações de Estudo</li>
                    <li>Roadmap de estudos</li>
                </ul>
                <h3>Para professores</h3>
                <ul>
                    <li>Aprimoramento no gerenciamento de turmas</li>
                    <li>Possibilidade de adicionar avaliações à turma</li>
                </ul>

            </div>

            <div class="voltar-link">
                <a href="/mesominds/" class="voltar-btn">Voltar ao Início</a>
            </div>
        </div>
    </main>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>