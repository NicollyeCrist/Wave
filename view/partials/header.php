<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['usuario']);
$userName = $isLoggedIn ? $_SESSION['usuario']['nome'] : null;
$userType = $isLoggedIn ? $_SESSION['usuario']['tipo_usuario'] : null;
?>

<header>
    <nav>
        <div class="logo">
            <a href="/mesominds/">
                <img src="/mesominds/imgs/android-chrome-512x512.png">
            </a>
        </div>
        <a href="/mesominds/conteudos">Conteúdos</a>
        <a href="/mesominds/questoes">Questões</a>
        <a href="/mesominds/embreve">Simulados</a>

        <?php if ($isLoggedIn): ?>
            <a href="/mesominds/turmas">Turmas</a>

            <!-- Dropdown usuário -->
            <div class="profile-dropdown">
                <button class="profile-dropdown-toggle">
                    Olá, <?php echo htmlspecialchars($userName); ?>!
                    <span class="arrow">&#9662;</span>
                </button>
                <div class="profile-dropdown-menu">
                    <a href="/mesominds/profile">Meu Perfil</a>
                    <a href="/mesominds/turmas">Minhas Turmas</a>
                    <?php if ($userType === 'professor'): ?>
                        <a href="/mesominds/turmas/criar">Criar Turma</a>
                    <?php endif; ?>
                    <a href="/mesominds/logout" class="logout-link">Sair</a>
                </div>
            </div>
        <?php else: ?>
            <div class="loginButton">
                <a href="/mesominds/login">Cadastrar</a>
            </div>
        <?php endif; ?>
    </nav>
</header>

<!-- JSdropdown -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const dropdown = document.querySelector('.profile-dropdown');
    if (dropdown) {
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
    }
  });
</script>
