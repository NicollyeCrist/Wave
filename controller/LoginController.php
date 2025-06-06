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
    }    public function login(string $nome = '', string $senha = ''): void {
        session_start();
        
        if (empty($nome) && empty($senha)) {
            $nome = $_POST['nome'] ?? '';
            $senha = $_POST['senha'] ?? '';
        }

        // Substituir espaços por underline no nome
        $nome = str_replace(' ', '_', trim($nome));

        try {
            $usuario = $this->dao->searchByNome($nome);

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
