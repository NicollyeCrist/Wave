<?php

require_once __DIR__ . '/../model/dbConnection.php';
require_once __DIR__ . '/../model/Turma.php';
require_once __DIR__ . '/../model/TurmaDao.php';

class TurmaController
{
    protected TurmaDao $turmaDao;

    public function __construct()
    {
        $this->turmaDao = new TurmaDao();
    }
    protected function isAuthenticated(): bool
    {
        return isset($_SESSION['usuario']);
    }    protected function render(string $view, array $data = []): void
    {
        extract($data);

        require __DIR__ . '/../view/' . $view . '.php';
    }
}
?>