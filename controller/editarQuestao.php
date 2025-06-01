<?php
require_once __DIR__ . '/QuestaoController.php';
require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';
require_once __DIR__ . '/../model/ConteudoDao.php';

class EditarQuestao extends QuestaoController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function edit(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        $questao = $this->dao->readById($id);
        if (!$questao) {
            echo "Questão não encontrada.";
            exit;
        }

        $alternativaDao = new AlternativaDao();
        $alternativas = $alternativaDao->readByQuestaoId($id);

        $conteudoDao = new ConteudoDao();
        $conteudos = $conteudoDao->readAll();

        require __DIR__ . '/../view/editarQuestao.php';
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