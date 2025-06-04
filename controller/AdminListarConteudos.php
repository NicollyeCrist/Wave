<?php
require_once __DIR__ . '/AdminController.php';

class AdminListarConteudos extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show(): void
    {
        session_start();
        
        if (!$this->isAdminAuthenticated()) {
            $this->redirect('/admin/login');
        }

        try {
            $idDisciplina = filter_input(INPUT_GET, 'disciplina', FILTER_VALIDATE_INT);
            
            $disciplinas = $this->DisciplinaDao->readAll();
            
            if ($idDisciplina) {
                $conteudos = $this->ConteudoDao->findByDisciplina($idDisciplina);
                $disciplinaSelecionada = $this->DisciplinaDao->findById($idDisciplina);
            } else {
                $conteudos = $this->ConteudoDao->readAll();
                $disciplinaSelecionada = null;
            }            
            $countAll = $this->ConteudoDao->countAll();
            $totalDisciplinas = $this->DisciplinaDao->countAll();

            $data = [
                'conteudos' => $conteudos,
                'disciplinas' => $disciplinas,
                'disciplinaSelecionada' => $disciplinaSelecionada,
                'idDisciplina' => $idDisciplina,
                'countAll' => $countAll,
                'totalDisciplinas' => $totalDisciplinas
            ];

            $this->render('admin/listarConteudos', $data);
            
        } catch (Exception $e) {
            error_log("AdminListarConteudos::show() - Erro: " . $e->getMessage());
            $this->setMessage('Erro ao carregar conteúdos: ' . $e->getMessage(), 'error');
            $this->redirect('/admin/dashboard');
        }
    }

    public function list(): void
    {
        $this->show();
    }

    public function edit(): void {}
    public function update(): void {}
    public function delete(): void {}
}
