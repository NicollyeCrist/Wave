<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - MesoMinds</title>
    <link rel="stylesheet" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/register.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
</head>

<body>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php';
    ?>
    <div class="register-container">
        <div class="logo-area">
            <div class="logoImg">
                <img src="/mesominds/imgs/android-chrome-512x512.png">
            </div>
        </div>

        <form class="register-form" method="POST" action="/mesominds/controller/registerController.php">
            <h2 class="register-title">Registro</h2>

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
                <label class="form-label">Nome</label>
                <input type="text" class="form-input" name="nome" required
                    value="<?= isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '' ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Telefone</label>
                <input type="tel" class="form-input" name="telefone" required
                    value="<?= isset($_POST['telefone']) ? htmlspecialchars($_POST['telefone']) : '' ?>">
            </div>

            <div class="form-group">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-input" name="email" required
                    value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Como deseja se cadastrar:</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="professor" name="tipo_usuario" value="professor" required>
                        <label for="professor">Professor</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="aluno" name="tipo_usuario" value="aluno">
                        <label for="aluno">Aluno</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Escola</label>
                <input type="text" class="form-input" name="escola" required
                    value="<?= isset($_POST['escola']) ? htmlspecialchars($_POST['escola']) : '' ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Senha</label>
                <input type="password" class="form-input" name="senha" required minlength="6">
                <small class="form-hint">Mínimo 6 caracteres</small>
            </div>

            <div class="form-group">
                <label class="form-label">Confirme a senha</label>
                <input type="password" class="form-input" name="confirma_senha" required minlength="6">
            </div>

            <button type="submit" class="register-btn">Registrar-se</button>

            <div class="login-link">
                <p>Já tem uma conta? <a href="/mesominds/login">Faça login</a></p>
            </div>
        </form>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>