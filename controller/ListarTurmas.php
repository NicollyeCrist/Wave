<?php
require_once __DIR__ . '/TurmaController.php';
require_once __DIR__ . '/../model/UsuarioDao.php';

class ListarTurmas extends TurmaController
{
    public function list(): void
    {
        session_start();
          if (!$this->isAuthenticated()) {
            header('Location: /mesominds/login');
            exit;
        }try {
            $turmas = $this->turmaDao->readAll();
            $userTurmas = $this->turmaDao->getTurmasByUsuario($_SESSION['usuario']['id']);
            
            $data = [
                'turmas' => $turmas,
                'userTurmas' => $userTurmas
            ];
            
            $this->render('turmas', $data);
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erro ao carregar turmas: ' . $e->getMessage();
            $this->render('turmas', ['turmas' => [], 'userTurmas' => []]);
        }
    }
}
