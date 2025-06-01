<?php
require_once __DIR__ . '/QuestaoController.php';
require_once __DIR__ . '/../model/ConteudoDao.php';

class ListarQuestoes extends QuestaoController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function list(): void{
    $questoes = $this->dao->readAll();
        $mapConteudos = [];
        foreach ((new ConteudoDao())->readAll() as $c) {
            $mapConteudos[$c->getIdConteudo()] = $c->getTitulo();
        }
        require __DIR__ . '/../view/listarQuestoes.php';
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

$ctrl = new ListarQuestoes();
$ctrl->list();
