<?php
require_once __DIR__ . '/adminController.php';
require_once __DIR__ . '/../model/ConteudoDao.php';
require_once __DIR__ . '/../model/QuestoesDao.php';

class ListarQuestoes extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
      public function list(): void
    {
        session_start();
        
        if (!$this->isAdminAuthenticated()) {
            $this->redirect('/admin/login');
        }
        
        try {
            $questoesDao = new QuestoesDao();
            $questoes = $questoesDao->readAll();
            
            $mapConteudos = [];
            foreach ($this->ConteudoDao->readAll() as $c) {
                $mapConteudos[$c->getId()] = $c->getTitulo();
            }
            
            $data = [
                'questoes' => $questoes,
                'mapConteudos' => $mapConteudos            ];
            
            $this->render('admin/listarQuestoes', $data);
        } catch (Exception $e) {
            error_log("ListarQuestoes::list() - Erro: " . $e->getMessage());
            $this->setMessage('Erro ao carregar questões: ' . $e->getMessage(), 'error');
            $this->render('admin/listarQuestoes', ['questoes' => [], 'mapConteudos' => []]);
        }
    }

    public function show(): void
    {
        $this->list();
    }

    public function create(): void
    {
    }

    public function edit(): void
    {
    }

    public function update(): void
    {
    }

    public function delete(): void
    {
    }
}
