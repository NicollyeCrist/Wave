<?php
require_once __DIR__ . '/QuestaoController.php';
require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';
require_once __DIR__ . '/../model/Questoes.php';
require_once __DIR__ . '/../model/dbConnection.php';
class AtualizaQuestao extends QuestaoController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function update(): void
    {
        $id = filter_input(INPUT_POST, 'idquestao', FILTER_VALIDATE_INT);
        $enunciado = filter_input(INPUT_POST, 'enunciado', FILTER_SANITIZE_STRING);
        $idconteudo = filter_input(INPUT_POST, 'idconteudo', FILTER_VALIDATE_INT);
        if ($id && $enunciado && $idconteudo) {
            $questao = new Questoes();
            $questao->setIdQuestao($id);
            $questao->setEnunciado($enunciado);
            $questao->setIdConteudo($idconteudo);
            $this->dao->update($questao);
            header('Location: ../view/listarQuestoes.php?msg=atualizada');
        } else {
            echo "Dados inválidos.";
        }
    }

    public function delete(): void
    {
    }

    public function create(): void
    {
    }

    public function edit(): void
    {
    }

    public function list(): void
    {
    }
}

$ctrl = new AtualizaQuestao();
$ctrl->update();