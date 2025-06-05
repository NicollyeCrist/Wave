<?php

require_once __DIR__ . '/AdminController.php';

class AdminLoginController extends AdminController {
      public function show(): void {
        session_start();
        
        if ($this->isAdminAuthenticated()) {
            $this->redirect('/admin/dashboard');
        }
        
        $this->render('admin/adminLogin');
    }

    public function login(): void {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/login');
        }

        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'] ?? '';

            if (empty($email) || empty($senha)) {
                $this->setMessage('Por favor, preencha todos os campos.', 'error');
                $this->redirect('/admin/login');
            }

            $admin = $this->adminDao->findByEmail($email);

            if (!$admin) {
                $this->setMessage('Email ou senha incorretos.', 'error');
                $this->redirect('/admin/login');
            }

            if (!$admin->verificarSenha($senha)) {
                $this->setMessage('Email ou senha incorretos.', 'error');
                $this->redirect('/admin/login');
            }

            if (!$admin->isAtivo()) {
                $this->setMessage('Conta desativada. Entre em contato com o administrador.', 'error');
                $this->redirect('/admin/login');
            }

            $_SESSION['admin'] = [
                'id' => $admin->getId(),
                'nome' => $admin->getNome(),
                'email' => $admin->getEmail(),
                'cargo' => $admin->getCargo()
            ];

            $this->adminDao->updateUltimoLogin($admin->getId());

            $this->setMessage('Login realizado com sucesso!', 'success');
            $this->redirect('/admin/dashboard');

        } catch (Exception $e) {
            error_log("Erro no login admin: " . $e->getMessage());
            $this->setMessage('Erro interno. Tente novamente.', 'error');
            $this->redirect('/admin/login');
        }
    }

    public function logout(): void {
        session_start();
        
        unset($_SESSION['admin']);
        unset($_SESSION['admin_mensagem']);
        unset($_SESSION['admin_tipo_mensagem']);
        
        session_destroy();
        
        $this->setMessage('Logout realizado com sucesso!', 'success');
        $this->redirect('/admin/login');
    }
}
?>
