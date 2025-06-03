<?php

require_once __DIR__ . '/TurmaController.php';

class DeletarTurma extends TurmaController
{
    public function delete(): void
    {
        session_start();
        
        if (!$this->isAuthenticated()) {
            header('Location: /mesominds/login');
            exit;
        }

        if ($_SESSION['usuario']['tipo_usuario'] !== 'professor') {
            $_SESSION['error'] = 'Apenas professores podem deletar turmas.';
            header('Location: /mesominds/turmas');
            exit;
        }

        $id = $_POST['id'] ?? $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'ID da turma não fornecido.';
            header('Location: /mesominds/turmas');
            exit;
        }

        try {
            $turma = $this->turmaDao->readById($id);
            if (!$turma) {
                $_SESSION['error'] = 'Turma não encontrada.';
                header('Location: /mesominds/turmas');
                exit;
            }

            $usuarios = $this->turmaDao->getUsuariosByTurma($id);
            foreach ($usuarios as $usuario) {
                $this->turmaDao->removeUsuarioFromTurma($id, $usuario['id']);
            }

            $this->turmaDao->delete($id);
            $_SESSION['success'] = 'Turma deletada com sucesso!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erro ao deletar turma: ' . $e->getMessage();
        }

        header('Location: /mesominds/turmas');
        exit;
    }
}
