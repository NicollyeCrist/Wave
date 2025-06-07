<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/profile.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
    <title>Perfil - MesoMinds</title>
</head>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const dropdown = document.querySelector('.profile-dropdown');
    const toggle = dropdown.querySelector('.profile-dropdown-toggle');

    toggle.addEventListener('click', function (e) {
      e.stopPropagation();
      dropdown.classList.toggle('show');
    });

    window.addEventListener('click', function (e) {
      if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('show');
      }
    });
  });
</script>


<body>
    <?php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php';

    if (!isset($_SESSION['usuario'])) {
        header('Location: /login');
        exit;
    }

    $usuario = $_SESSION['usuario'];
    ?>

    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <div class="avatar-circle">
                    <?php echo strtoupper(substr($usuario['nome'], 0, 2)); ?>
                </div>
            </div>
            <div class="profile-info">
                <h1 class="profile-name"><?php echo htmlspecialchars($usuario['nome']); ?></h1>
                <p class="profile-type"><?php echo ucfirst($usuario['tipo_usuario']); ?></p>
                <p class="profile-school"><?php echo htmlspecialchars($usuario['escola']); ?></p>
            </div>
        </div> <?php if (isset($_SESSION['mensagem_sucesso'])): ?>
            <div class="alert alert-success">
                <strong>Sucesso!</strong> <?php
                echo htmlspecialchars($_SESSION['mensagem_sucesso']);
                unset($_SESSION['mensagem_sucesso']);
                ?>
            </div>
        <?php endif; ?>

        <div class="profile-content">
            <div class="profile-section">
                <h2>Dados do Usuário</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Nome Completo</label>
                        <span><?php echo htmlspecialchars($usuario['nome']); ?></span>
                    </div>
                    <!--<div class="info-item">
                        <label>Email</label>
                        <span><?php echo htmlspecialchars($usuario['email']); ?></span>
                    </div>-->
                    <div class="info-item">
                        <label>Tipo de Usuário</label>
                        <span><?php echo ucfirst($usuario['tipo_usuario']); ?></span>
                    </div>
                    <div class="info-item">
                        <label>Instituição</label>
                        <span><?php echo htmlspecialchars($usuario['escola']); ?></span>
                    </div>
                </div>
            </div>
            <div class="profile-section">
                <h2>Navegação</h2>
                <div class="action-buttons">
                    <a href="/questoes" class="btn btn-primary">Questões</a>
                    <a href="/conteudos" class="btn btn-secondary">Conteúdos</a>
                    <a href="/mesominds/turmas" class="btn btn-secondary">Turmas</a>
                    <a href="/mesominds/logout" class="btn btn-danger">Sair</a>
                </div>
            </div>
            <?php if ($usuario['tipo_usuario'] === 'professor'): ?>
                <div class="profile-section">
                    <h2>Ferramentas do Professor</h2>
                    <div class="professor-actions">
                        <a href="/questoes/cadastrar" class="btn btn-success">Nova Questão</a>
                        <a href="/conteudos/cadastrar" class="btn btn-success">Novo Conteúdo</a>
                        <a href="/mesominds/turmas/criar" class="btn btn-success">Nova Turma</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>