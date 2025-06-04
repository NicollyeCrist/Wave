<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo - MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/login.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <div class="login-box admin-login">
            <div class="login-header">
                <h1>🔐 Área Administrativa</h1>
                <p>Acesso restrito para administradores</p>
            </div>

            <?php if (isset($_SESSION['admin_mensagem'])): ?>
                <div class="mensagem <?= $_SESSION['admin_tipo_mensagem'] ?>">
                    <?= htmlspecialchars($_SESSION['admin_mensagem']) ?>
                </div>
                <?php
                unset($_SESSION['admin_mensagem']);
                unset($_SESSION['admin_tipo_mensagem']);
                ?>
            <?php endif; ?>

            <form action="/mesominds/admin/login" method="post" class="login-form">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required 
                           placeholder="admin@mesominds.com" 
                           value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required 
                           placeholder="Digite sua senha">
                </div>

                <button type="submit" class="btn-login admin-btn">
                    Entrar no Sistema
                </button>
            </form>

            <div class="login-footer">
                <p><a href="/mesominds/">← Voltar ao site</a></p>
                <p><small>Sistema de Gerenciamento MesoMinds</small></p>
            </div>
        </div>
    </div>

    <style>
        .admin-login {
            border-top: 4px solid #dc3545;
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        }
        
        .admin-login .login-header h1 {
            color: #dc3545;
        }
        
        .admin-btn {
            background: #dc3545;
            border-color: #dc3545;
        }
        
        .admin-btn:hover {
            background: #c82333;
            border-color: #bd2130;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .login-footer a {
            color: #6c757d;
            text-decoration: none;
        }
        
        .login-footer a:hover {
            color: #dc3545;
        }
    </style>
</body>
</html>
