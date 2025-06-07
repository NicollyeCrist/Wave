<?php

require_once __DIR__ . '/TurmaController.php';

class EditarTurma extends TurmaController
{
    public function edit(): void
    {
        session_start();
        
        if (!$this->isAuthenticated()) {
            header('Location: /mesominds/login');
            exit;
        }

        if ($_SESSION['usuario']['tipo_usuario'] !== 'professor') {
            $_SESSION['error'] = 'Apenas professores podem editar turmas.';
            header('Location: /mesominds/turmas');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'ID da turma não fornecido.';
            header('Location: /mesominds/turmas');
            exit;
        }

        $turma = $this->turmaDao->readById($id);
        if (!$turma) {
            $_SESSION['error'] = 'Turma não encontrada.';
            header('Location: /mesominds/turmas');
            exit;
        }

        $data = ['turma' => $turma];
        $this->render('editarTurma', $data);
    }

    public function update(): void
    {
        session_start();
        
        if (!$this->isAuthenticated()) {
            header('Location: /mesominds/login');
            exit;
        }

        if ($_SESSION['usuario']['tipo_usuario'] !== 'professor') {
            $_SESSION['error'] = 'Apenas professores podem editar turmas.';
            header('Location: /mesominds/turmas');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $nome = trim($_POST['nome'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');

        if (!$id || empty($nome)) {
            $_SESSION['error'] = 'ID da turma e nome são obrigatórios.';
            header('Location: /mesominds/turmas/editar?id=' . $id);
            exit;
        }

        try {
            $turma = new Turma();
            $turma->setId($id);
            $turma->setNome($nome);
            $turma->setDescricao($descricao);

            $this->turmaDao->update($turma);
            $_SESSION['success'] = 'Turma atualizada com sucesso!';
            header('Location: /mesominds/turmas');
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erro ao atualizar turma: ' . $e->getMessage();
            header('Location: /mesominds/turmas/editar?id=' . $id);
        }
        exit;
    }
}
