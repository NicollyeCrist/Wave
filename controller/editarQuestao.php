<?php
require_once __DIR__ . '/adminController.php';
require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';
require_once __DIR__ . '/../model/ConteudoDao.php';

class EditarQuestao extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function edit(): void
    {
        session_start();
        
        if (!$this->isAdminAuthenticated()) {
            $this->redirect('/admin/login');
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);        if (!$id) {
            $this->setMessage("ID inválido ou não fornecido.", 'error');
            $this->redirect('/admin/questoes');
            return;
        }$questoesDao = new QuestoesDao();
        $questao = $questoesDao->readById($id);        if (!$questao) {
            $this->setMessage("Questão não encontrada.", 'error');
            $this->redirect('/admin/questoes');
            return;
        }

        $alternativaDao = new AlternativaDao();
        $alternativas = $alternativaDao->readByQuestaoId($id);

        $conteudos = $this->ConteudoDao->readAll();

        $data = [
            'questao' => $questao,
            'alternativas' => $alternativas,
            'conteudos' => $conteudos
        ];

        $this->render('admin/editarQuestao', $data);
    }

    public function show(): void
    {
        $this->edit();
    }
    public function delete(): void
    {
    }

    public function create(): void
    {
    }

    public function update(): void
    {
    }

    public function list(): void
    {
    }
}