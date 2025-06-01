<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="../CSS/global.css">
    <link rel="stylesheet" type="text/css" href="../CSS/login.css"> 
    <link rel="stylesheet" type="text/css" href="../view/partials/header.css">
    <link rel="stylesheet" type="text/css" href="../view/partials/footer.css">
</head>

<body>
    <?php include_once '../view/partials/header.php' ?>
    <div class="login-container">
        <div class="logo-area">
            <div class="logoImg">
                <img src="../imgs/android-chrome-512x512.png" alt="MesoMinds Logo">
            </div>
        </div>

        <form class="login-form" method="POST" action="../controller/login_controller.php">
            <h2 class="login-title">Login</h2>

            <div class="form-group">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" class="form-input" name="email" required>
            </div>

            <div class="form-group">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" id="senha" class="form-input" name="senha" required>
            </div>

            <button type="submit" class="login-btn">Entrar</button>

            <div class="register-link-container">
                <span>Não tem uma conta?</span> <a href="register.php" class="register-link">Registre-se</a>
            </div>
        </form>
    </div>
    <?php include_once '../view/partials/footer.php' ?>

</body>

</html>