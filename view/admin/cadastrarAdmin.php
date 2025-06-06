<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Administrador - MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/register.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="register-container">
        <div class="register-box admin-register">
            <div class="register-header">
                <h1>👤 Cadastrar Novo Administrador</h1>
                <p>Adicionar novo membro à equipe administrativa</p>
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

            <form action="/mesominds/admin/cadastrar" method="post" class="register-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome Completo: *</label>
                        <input type="text" id="nome" name="nome" required 
                               placeholder="Ex: João Silva"
                               value="<?= isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email: *</label>
                        <input type="email" id="email" name="email" required 
                               placeholder="joao@mesominds.com"
                               value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="tel" id="telefone" name="telefone" 
                               placeholder="(11) 99999-9999"
                               value="<?= isset($_POST['telefone']) ? htmlspecialchars($_POST['telefone']) : '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="cargo">Cargo:</label>
                        <select id="cargo" name="cargo">
                            <option value="Administrador" <?= (isset($_POST['cargo']) && $_POST['cargo'] === 'Administrador') ? 'selected' : '' ?>>Administrador</option>
                            <option value="Super Administrador" <?= (isset($_POST['cargo']) && $_POST['cargo'] === 'Super Administrador') ? 'selected' : '' ?>>Super Administrador</option>
                            <option value="Moderador" <?= (isset($_POST['cargo']) && $_POST['cargo'] === 'Moderador') ? 'selected' : '' ?>>Moderador</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="senha">Senha: *</label>
                        <input type="password" id="senha" name="senha" required 
                               placeholder="Mínimo 6 caracteres"
                               minlength="6">
                    </div>

                    <div class="form-group">
                        <label for="confirmar_senha">Confirmar Senha: *</label>
                        <input type="password" id="confirmar_senha" name="confirmar_senha" required 
                               placeholder="Digite a senha novamente">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-register admin-btn">
                        Cadastrar Administrador
                    </button>
                    <a href="/mesominds/admin/dashboard" class="btn-cancel">
                        Cancelar
                    </a>
                </div>
            </form>

            <div class="register-footer">
                <p><small>* Campos obrigatórios</small></p>
                <p><small>O administrador receberá as credenciais por email</small></p>
            </div>
        </div>
    </div>

    <style>
        .admin-register {
            border-top: 4px solid #dc3545;
            max-width: 600px;
        }
        
        .admin-register .register-header h1 {
            color: #dc3545;
        }
        
        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .admin-btn {
            background: #dc3545;
            border-color: #dc3545;
        }
        
        .admin-btn:hover {
            background: #c82333;
            border-color: #bd2130;
        }
        
        .btn-cancel {
            background: #6c757d;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-left: 10px;
        }
        
        .btn-cancel:hover {
            background: #5a6268;
        }
        
        .form-actions {
            display: flex;
            align-items: center;
            margin-top: 25px;
        }
        
        .register-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #6c757d;
        }
        
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn-cancel {
                margin-left: 0;
            }
        }
    </style>

    <script>
        document.getElementById('confirmar_senha').addEventListener('input', function() {
            const senha = document.getElementById('senha').value;
            const confirmarSenha = this.value;
            
            if (senha !== confirmarSenha) {
                this.setCustomValidity('As senhas não coincidem');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>
