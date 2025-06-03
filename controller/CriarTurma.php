<?php
require_once __DIR__ . '/TurmaController.php';

class CriarTurma extends TurmaController
{
    public function show(): void
    {
        session_start();
        
        if (!$this->isAuthenticated()) {
            header('Location: /mesominds/login');
            exit;
        }

        if ($_SESSION['usuario']['tipo_usuario'] !== 'professor') {
            $_SESSION['error'] = 'Apenas professores podem criar turmas.';
            header('Location: /mesominds/turmas');
            exit;
        }

        $this->render('criarTurma');
    }

    public function create(): void
    {
        session_start();
        
        if (!$this->isAuthenticated()) {
            header('Location: /mesominds/login');
            exit;
        }

        if ($_SESSION['usuario']['tipo_usuario'] !== 'professor') {
            $_SESSION['error'] = 'Apenas professores podem criar turmas.';
            header('Location: /mesominds/turmas');
            exit;
        }

        $nome = trim($_POST['nome'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');

        if (empty($nome)) {
            $_SESSION['error'] = 'Nome da turma é obrigatório.';
            header('Location: /mesominds/turmas/cadastrar');
            exit;
        }

        try {
            $turma = new Turma();
            $turma->setNome($nome);
            $turma->setDescricao($descricao);

            $idTurma = $this->turmaDao->create($turma);
            
            $this->turmaDao->addUsuarioToTurma($idTurma, $_SESSION['usuario']['id']);

            $_SESSION['success'] = 'Turma criada com sucesso!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erro ao criar turma: ' . $e->getMessage();
        }

        header('Location: /mesominds/turmas');
        exit;
    }

}
