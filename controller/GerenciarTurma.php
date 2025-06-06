<?php

require_once __DIR__ . '/TurmaController.php';

class GerenciarTurma extends TurmaController
{
    public function entrar(): void
    {
        session_start();

        if (!$this->isAuthenticated()) {
            header('Location: /mesominds/login');
            exit;
        }

        $turmaId = $_POST['turma_id'] ?? null;
        if (!$turmaId) {
            $_SESSION['error'] = 'ID da turma não fornecido.';
            header('Location: /mesominds/turmas');
            exit;
        }
        try {
            $userId = $_SESSION['usuario']['id'];
            $turma = $this->turmaDao->readById($turmaId);
            if (!$turma) {
                $_SESSION['error'] = 'Turma não encontrada.';
                header('Location: /mesominds/turmas');
                exit;
            }

            $userTurmas = $this->turmaDao->getTurmasByUsuario($userId);
            foreach ($userTurmas as $userTurma) {
                if ($userTurma->getId() == $turmaId) {
                    $_SESSION['error'] = 'Você já está inscrito nesta turma.';
                    header('Location: /mesominds/turmas');
                    exit;
                }
            }

            $this->turmaDao->addUsuarioToTurma($turmaId, $userId);
            $_SESSION['success'] = 'Inscrição realizada com sucesso!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erro ao entrar na turma: ' . $e->getMessage();
        }

        header('Location: /mesominds/turmas');
        exit;
    }
    public function sair(): void
    {
        session_start();

        if (!$this->isAuthenticated()) {
            header('Location: /mesominds/login');
            exit;
        }

        $turmaId = $_POST['turma_id'] ?? null;
        if (!$turmaId) {
            $_SESSION['error'] = 'ID da turma não fornecido.';
            header('Location: /mesominds/turmas');
            exit;
        }
        try {
            $userId = $_SESSION['usuario']['id'];

            $this->turmaDao->removeUsuarioFromTurma($turmaId, $userId);
            $_SESSION['success'] = 'Você saiu da turma com sucesso!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erro ao sair da turma: ' . $e->getMessage();
        }

        header('Location: /mesominds/turmas');
        exit;
    }
    public function detalhes(): void
    {
        session_start();

        if (!$this->isAuthenticated()) {
            header('Location: /mesominds/login');
            exit;
        }

        $turmaId = $_GET['id'] ?? null;
        if (!$turmaId) {
            $_SESSION['error'] = 'ID da turma não fornecido.';
            header('Location: /mesominds/turmas');
            exit;
        }

        try {
            $turma = $this->turmaDao->readById($turmaId);
            if (!$turma) {
                $_SESSION['error'] = 'Turma não encontrada.';
                header('Location: /mesominds/turmas');
                exit;
            }
            $usuarios = $this->turmaDao->getUsuariosByTurma($turmaId);
            $userTurmas = $this->turmaDao->getTurmasByUsuario($_SESSION['usuario']['id']);

            $isUserInTurma = false;
            foreach ($userTurmas as $userTurma) {
                if ($userTurma->getId() == $turmaId) {
                    $isUserInTurma = true;
                    break;
                }
            }

            $data = [
                'turma' => $turma,
                'usuarios' => $usuarios,
                'isUserInTurma' => $isUserInTurma
            ];

            $this->render('turmaDetalhes', $data);
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erro ao carregar detalhes da turma: ' . $e->getMessage();
            header('Location: /mesominds/turmas');
            exit;
        }
    }
}
