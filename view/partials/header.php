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
        <a href="#">Simulados</a>
        
        <?php if ($isLoggedIn): ?>
            <a href="/mesominds/turmas">Turmas</a>
            <div class="user-menu">
                <span class="user-name">Olá, <?php echo htmlspecialchars($userName); ?>!</span>                <div class="user-dropdown" id="userDropdown">
                    <button class="user-dropdown-btn" onclick="toggleDropdown()">
                        <i class="fas fa-user"></i>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="user-dropdown-content">
                        <a href="/mesominds/profile">Meu Perfil</a>
                        <a href="/mesominds/turmas">Minhas Turmas</a>
                        <?php if ($userType === 'professor'): ?>
                            <a href="/mesominds/turmas/criar">Criar Turma</a>
                        <?php endif; ?>
                        <div class="dropdown-divider"></div>
                        <a href="/mesominds/logout" class="logout-link">Sair</a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="loginButton">
                <a href="/mesominds/login">Cadastrar</a>
            </div>
        <?php endif; ?>
    </nav>
</header>