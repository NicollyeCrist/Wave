<?php
require_once __DIR__ . '/../model/UsuarioDao.php';
require_once __DIR__ . '/../controller/UserController.php';


class LoginController extends UserController{

    public function show(): void {
        session_start();
        
        if (isset($_SESSION['usuario'])) {
            header('Location: /mesominds/profile');
            exit;
        }
        
        require_once __DIR__ . '/../view/login.php';
    }

    public function login(string $email = '', string $senha = ''): void {
        session_start();
        
        if (empty($email) && empty($senha)) {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
        }        try {
            $usuario = $this->dao->searchByEmail($email);

            if (!$usuario) {
                $_SESSION['mensagem_erro'] = 'Usuário não encontrado.';
                header('Location: /mesominds/login');
                exit;
            }

            if (!password_verify($senha, $usuario['senha'])) {
                $_SESSION['mensagem_erro'] = 'Senha incorreta.';
                header('Location: /mesominds/login');
                exit;
            }

            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'email' => $usuario['email'],
                'tipo_usuario' => $usuario['tipo_usuario'],
                'escola' => $usuario['escola']
            ];

            $_SESSION['mensagem_sucesso'] = 'Login realizado com sucesso!';

            header('Location: /mesominds/profile');
        } catch (Exception $e) {
            $_SESSION['mensagem_erro'] = 'Erro interno: ' . $e->getMessage();
            header('Location: /mesominds/login');
        }
    }

    public function create(): void{}
}
