<?php
require_once __DIR__ . '/../model/DbConnection.php';
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../model/UsuarioDao.php';
require_once __DIR__ . '/../controller/UserController.php';


class RegisterUserController extends UserController
{
    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $tipo_usuario = $_POST['tipo_usuario'];
            $escola = $_POST['escola'];
            $senha = $_POST['senha'];
            $confirma_senha = $_POST['confirma_senha'];

            if ($senha !== $confirma_senha) {
                die('As senhas não coincidem.');
            }

            try {
                $usuario = new Usuario();
                $usuario->setNome($nome);
                $usuario->setTelefone($telefone);
                $usuario->setEmail($email);
                $usuario->setSenha($senha);
                $usuario->setTipoUsuario($tipo_usuario);
                $usuario->setEscola($escola);

                $this->dao->create($usuario);
                header("Location: /mesominds/profile");
            } catch (Exception $e) {
                die('Erro: ' . $e->getMessage());
            }
        }
    }
    public function login(string $email, string $senha): void{}

}

$controller = new RegisterUserController();
$controller->create();
