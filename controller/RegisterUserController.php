<?php
session_start();

require_once __DIR__ . '/../model/DbConnection.php';
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../model/UsuarioDao.php';
require_once __DIR__ . '/../controller/UserController.php';

class RegisterUserController extends UserController
{
    public function show(): void { 
        require_once __DIR__ . '/../view/register.php';
    }

    public function register(): void {
        $this->create();
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $telefone = $_POST['telefone'] ?? '';
            $email = $_POST['email'] ?? '';
            $tipo_usuario = $_POST['tipo_usuario'] ?? '';
            $escola = $_POST['escola'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $confirma_senha = $_POST['confirma_senha'] ?? '';

            if (empty($nome) || empty($tipo_usuario) || empty($escola) || empty($senha)) {
                $_SESSION['mensagem_erro'] = 'Todos os campos são obrigatórios.';
                header("Location: /mesominds/register");
                exit;
            }

            if ($senha !== $confirma_senha) {
                $_SESSION['mensagem_erro'] = 'As senhas não coincidem.';
                header("Location: /mesominds/register");
                exit;
            }

            if (strlen($senha) < 6) {
                $_SESSION['mensagem_erro'] = 'A senha deve ter pelo menos 6 caracteres.';
                header("Location: /mesominds/register");
                exit;
            }

            try {
                $usuarioExistente = $this->dao->searchByEmail($email);
                if ($usuarioExistente) {
                    $_SESSION['mensagem_erro'] = 'Email já cadastrado. Tente fazer login.';
                    header("Location: /mesominds/register");
                    exit;
                }

                $usuario = new Usuario();
                $usuario->setNome($nome);
                $usuario->setTelefone($telefone);
                $usuario->setEmail($email);
                $usuario->setSenha($senha);
                $usuario->setTipoUsuario($tipo_usuario);
                $usuario->setEscola($escola);

                $this->dao->create($usuario);
                
                $_SESSION['mensagem_sucesso'] = 'Cadastro realizado com sucesso! Faça seu login.';
                header("Location: /mesominds/login");
                exit;
                
            } catch (Exception $e) {
                $_SESSION['mensagem_erro'] = 'Erro ao cadastrar usuário: ' . $e->getMessage();
                header("Location: /mesominds/register");
                exit;
            }
        } else {
            header("Location: /mesominds/register");
            exit;
        }
    }
      public function login(string $email, string $senha): void
    {
    }
}
