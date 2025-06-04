<?php
require_once __DIR__ . '/AdminController.php';

class DeletarConteudo extends AdminController
{

    public function __construct()
    {
        parent::__construct();

    }
    public function delete(): void
    {
        session_start();
        
        if (!$this->isAdminAuthenticated()) {
            $this->redirect('/login');
        }

        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if (!$id) {
                $this->setMessage('ID do conteúdo inválido.', 'error');
                $this->redirect('/conteudos');
            }

            $conteudo = $this->ConteudoDao->findById($id);
            if (!$conteudo) {
                $this->setMessage('Conteúdo não encontrado.', 'error');
                $this->redirect('/conteudos');
            }

            $resultado = $this->ConteudoDao->delete($id);
            
            if ($resultado) {
                $this->setMessage("Conteúdo deletado com sucesso!", "success");
            } else {
                $this->setMessage("Erro ao deletar conteúdo.", "error");
            }
        } catch (Exception $e) {
            $this->setMessage("Erro interno: " . $e->getMessage(), "error");
        }
        
        $this->redirect('/conteudos');
    }

    public function list(): void
    {
        $this->redirect('/conteudos');
    }

    public function create(): void
    {
        $this->redirect('/conteudos/cadastrar');
    }

    public function show(): void
    {
        // Method not implemented for delete controller
    }

    public function edit(): void
    {
        // Method not implemented for delete controller
    }

    public function update(): void
    {
        // Method not implemented for delete controller
    }
}
