<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - MesoMinds</title>
    <link rel="stylesheet" href="../CSS/global.css">
    <link rel="stylesheet" type="text/css" href="../CSS/global.css">
    <link rel="stylesheet" type="text/css" href="../CSS/register.css">
    <link rel="stylesheet" type="text/css" href="../view/partials/header.css">
    <link rel="stylesheet" type="text/css" href="../view/partials/footer.css">
    <style>

    </style>
</head>

<body>
    <?php include_once '../view/partials/header.php' ?>
    <div class="register-container">
        <div class="logo-area">
            <div class="logoImg">
                <img src="../imgs/android-chrome-512x512.png">
            </div>
        </div>

        <form class="register-form" method="POST" action="../controller/registerController.php">
            <h2 class="register-title">Registro</h2>

            <div class="form-group">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-input" name="email" required>
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
                <input type="text" class="form-input" name="escola" required>
            </div>

            <div class="form-group">
                <label class="form-label">Senha</label>
                <input type="password" class="form-input" name="senha" required>
            </div>

            <div class="form-group">
                <label class="form-label">Confirme a senha</label>
                <input type="password" class="form-input" name="confirma_senha" required>
            </div>

            <button type="submit" class="register-btn">Registrar-se</button>
        </form>
    </div>
    <?php include_once '../view/partials/footer.php' ?>

</body>

</html>