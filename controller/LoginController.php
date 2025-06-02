<?php
require_once __DIR__ . '/../model/UsuarioDao.php';
require_once __DIR__ . '/../controller/UserController.php';


class LoginController extends UserController{

    public function login(string $email, string $senha): void {
        try {
            $usuario = $this->dao->searchByEmail($email);

            if (!$usuario) {
                session_start();
                $_SESSION['mensagem_erro'] = 'Usuário não encontrado.';
                header('Location: /mesominds/login');
                exit;
            }

            if (!password_verify($senha, $usuario['senha'])) {
                session_start();
                $_SESSION['mensagem_erro'] = 'Senha incorreta.';
                header('Location: /mesominds/login');
                exit;
            }

            session_start();
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
            die('Erro: ' . $e->getMessage());
        }
    }

    public function create(): void{}

}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$controller = new LoginController();
$controller->login($email, $senha);
