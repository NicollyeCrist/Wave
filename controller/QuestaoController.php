<?php

require_once __DIR__ . '/../model/dbConnection.php';
require_once __DIR__ . '/../model/Questoes.php';
require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';

class QuestaoController
{
    protected QuestoesDao $dao;

    public function __construct()
    {
        $this->dao = new QuestoesDao();
    }

    public function list(): void
    {
        $questoes = $this->dao->readAll();
        $mapConteudos = [];
        foreach ((new ConteudoDao())->readAll() as $c) {
            $mapConteudos[$c->getIdConteudo()] = $c->getTitulo();
        }
        header('Location: ../view/listarQuestoes.php');
        exit;
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
