<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/login.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
</head>

<body>
    <?php 
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; 
    ?>
    <div class="login-container">
        <div class="logo-area">
            <div class="logoImg">
                <img src="/mesominds/imgs/android-chrome-512x512.png" alt="MesoMinds Logo">
            </div>
        </div>

        <form class="login-form" method="POST" action="/mesominds/controller/LoginController.php">
            <h2 class="login-title">Login</h2>

            <?php if (isset($_SESSION['mensagem_erro'])): ?>
                <div class="mensagem-erro">
                    <?= htmlspecialchars($_SESSION['mensagem_erro']) ?>
                </div>
                <?php unset($_SESSION['mensagem_erro']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['mensagem_sucesso'])): ?>
                <div class="mensagem-sucesso">
                    <?= htmlspecialchars($_SESSION['mensagem_sucesso']) ?>
                </div>
                <?php unset($_SESSION['mensagem_sucesso']); ?>
            <?php endif; ?>

            <div class="form-group">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" class="form-input" name="email" required>
            </div>

            <div class="form-group">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" id="senha" class="form-input" name="senha" required>
            </div>

            <button type="submit" class="login-btn">Entrar</button>
            <div class="forget-password-container">
                <span>Esqueceu a senha?</span> <a href="#" class="recovery-link">Recupere aqui</a>
            </div>

            <div class="register-link-container">
                <span>Não tem uma conta?</span> <a href="/mesominds/register" class="register-link">Registre-se</a>
            </div>
        </form>
    </div>

    <style>
        .mensagem-erro, .mensagem-sucesso {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
            font-weight: 500;
        }

        .mensagem-erro {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .mensagem-sucesso {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>