<?php
require_once __DIR__ . '/QuestaoController.php';
require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';
require_once __DIR__ . '/../model/Questoes.php';
require_once __DIR__ . '/../model/dbConnection.php';
class DeletaQuestao extends QuestaoController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function delete(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $this->dao->delete($id);
            header('Location: ../view/listarQuestoes.php?msg=deletada');
        } else {
            echo "ID inválido.";
        }
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

    public function list(): void
    {
    }
}
$crtl = new DeletaQuestao();
$crtl->delete();
