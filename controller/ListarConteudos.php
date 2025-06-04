<?php
require_once __DIR__ . '/ConteudoController.php';

class ListarConteudos extends ConteudoController
{
    public function list(): void
    {
        session_start();
        
        if (!$this->isAuthenticated()) {
            $this->redirect('/login');
        }

        try {
            $idDisciplina = filter_input(INPUT_GET, 'disciplina', FILTER_VALIDATE_INT);
            $disciplinaSelecionada = null;

            if ($idDisciplina) {
                $conteudos = $this->conteudoDao->findByDisciplina($idDisciplina);
                $disciplinaSelecionada = $this->disciplinaDao->findById($idDisciplina);
            } else {
                $conteudos = $this->conteudoDao->readAll();
            }

            $disciplinas = $this->disciplinaDao->readAll();

            $data = [
                'conteudos' => $conteudos,
                'disciplinas' => $disciplinas,
                'disciplinaSelecionada' => $disciplinaSelecionada,
                'idDisciplina' => $idDisciplina
            ];

            $this->render('listarConteudos', $data);
        } catch (Exception $e) {
            $this->setMessage('Erro ao carregar conteúdos: ' . $e->getMessage(), 'error');
            $this->render('listarConteudos', ['conteudos' => [], 'disciplinas' => [], 'disciplinaSelecionada' => null, 'idDisciplina' => null]);
        }
    }

    public function create(): void
    {
        // Method not implemented for listing controller
    }

    public function show(): void
    {
        // Method not implemented for listing controller
    }

    public function edit(): void
    {
        // Method not implemented for listing controller
    }

    public function update(): void
    {
        // Method not implemented for listing controller
    }

    public function delete(): void
    {
        // Method not implemented for listing controller
    }
}
