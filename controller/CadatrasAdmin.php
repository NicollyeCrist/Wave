<?php

require_once __DIR__ . '/AdminController.php';

class CadatrasAdmin extends AdminController {
      public function show(): void {
        session_start();
        $this->requireSuperAdmin(); 
        
        $this->render('admin/cadastrarAdmin');
    }

    public function create(): void {
        session_start();
        $this->requireSuperAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/cadastrar');
        }

        try {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
            $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_SPECIAL_CHARS);
            $senha = $_POST['senha'] ?? '';
            $confirmarSenha = $_POST['confirmar_senha'] ?? '';

            if (empty($nome) || empty($email) || empty($senha) || empty($confirmarSenha)) {
                $this->setMessage('Todos os campos obrigatórios devem ser preenchidos.', 'error');
                $this->redirect('/admin/cadastrar');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->setMessage('Email inválido.', 'error');
                $this->redirect('/admin/cadastrar');
            }

            if (strlen($senha) < 6) {
                $this->setMessage('A senha deve ter pelo menos 6 caracteres.', 'error');
                $this->redirect('/admin/cadastrar');
            }

            if ($senha !== $confirmarSenha) {
                $this->setMessage('As senhas não coincidem.', 'error');
                $this->redirect('/admin/cadastrar');
            }

            if ($this->adminDao->emailExists($email)) {
                $this->setMessage('Este email já está cadastrado.', 'error');
                $this->redirect('/admin/cadastrar');
            }

            $admin = new Admin();
            $admin->setNome($nome);
            $admin->setEmail($email);
            $admin->setTelefone($telefone);
            $admin->setCargo($cargo ?: 'Administrador');
            $admin->setSenha($senha); // A senha será hasheada automaticamente
            $admin->setAtivo(true);

            $id = $this->adminDao->create($admin);

            if ($id) {
                $this->setMessage('Administrador cadastrado com sucesso!', 'success');
                $this->redirect('/admin/dashboard');
            } else {
                $this->setMessage('Erro ao cadastrar administrador.', 'error');
                $this->redirect('/admin/cadastrar');
            }

        } catch (Exception $e) {
            error_log("Erro ao cadastrar admin: " . $e->getMessage());
            $this->setMessage('Erro interno. Tente novamente.', 'error');
            $this->redirect('/admin/cadastrar');
        }
    }
}