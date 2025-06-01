<?php

require_once __DIR__ . '/../model/dbConnection.php';
require_once __DIR__ . '/../model/Questoes.php';
require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';
require_once __DIR__ . '/../model/ConteudoDao.php';

abstract class QuestaoController
{
    protected QuestoesDao $dao;

    public function __construct()
    {
        $this->dao = new QuestoesDao();
    }

    abstract public function list(): void;

    abstract public function create(): void;
    abstract public function edit(): void;
    abstract public function update(): void;
    abstract public function delete(): void;
}
