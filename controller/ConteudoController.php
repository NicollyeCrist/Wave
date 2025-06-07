<?php

require_once __DIR__ . '/../model/dbConnection.php';
require_once __DIR__ . '/../model/Conteudo.php';
require_once __DIR__ . '/../model/ConteudoDao.php';
require_once __DIR__ . '/../model/DisciplinaDao.php';
require_once __DIR__ . '/../model/Disciplina.php';

abstract class ConteudoController
{
    protected ConteudoDao $conteudoDao;
    protected DisciplinaDao $disciplinaDao;

    public function __construct()
    {
        $this->conteudoDao = new ConteudoDao();
        $this->disciplinaDao = new DisciplinaDao();
    }

    protected function isAuthenticated(): bool
    {
        return isset($_SESSION['usuario']);
    }

    protected function isProfessor(): bool
    {
        return $this->isAuthenticated() && $_SESSION['usuario']['tipo_usuario'] === 'professor';
    }

    protected function render(string $view, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../view/' . $view . '.php';
    }

    protected function redirect(string $path): void
    {
        header("Location: /mesominds{$path}");
        exit;
    }

    protected function setMessage(string $message, string $type = 'success'): void
    {
        $_SESSION['mensagem'] = $message;
        $_SESSION['tipo_mensagem'] = $type;
    }

    abstract public function list(): void;
    abstract public function create(): void;
    abstract public function show(): void;
    abstract public function edit(): void;
    abstract public function update(): void;
    abstract public function delete(): void;
}
