<?php

require_once __DIR__ . '/../model/AdminDao.php';
require_once __DIR__ . '/../model/Admin.php';
require_once __DIR__ . '/../model/Conteudo.php';
require_once __DIR__ . '/../model/ConteudoDao.php';
require_once __DIR__ . '/../model/Disciplina.php';
require_once __DIR__ . '/../model/DisciplinaDao.php';
require_once __DIR__ . '/../model/Questoes.php';
require_once __DIR__ . '/../model/QuestoesDao.php';


abstract class AdminController {
    protected AdminDao $adminDao;
    protected ConteudoDao $ConteudoDao;
    protected DisciplinaDao $DisciplinaDao;
    protected QuestoesDao $QuestoesDao;

    public function __construct() {
        $this->adminDao = new AdminDao();
        $this->ConteudoDao = new ConteudoDao();
        $this->DisciplinaDao = new DisciplinaDao();
        $this->QuestoesDao = new QuestoesDao();
    }

    protected function isAdminAuthenticated(): bool {
        return isset($_SESSION['admin']);
    }

    protected function isSuperAdmin(): bool {
        return $this->isAdminAuthenticated() && $_SESSION['admin']['cargo'] === 'Super Administrador';
    }    protected function render(string $viewName, array $data = []): void {
        extract($data);
        
        $viewPath = __DIR__ . '/../view/' . $viewName . '.php';
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            throw new Exception("View não encontrada: " . $viewName);
        }
    }

    protected function redirect(string $path): void {
        header("Location: /mesominds{$path}");
        exit;
    }

    protected function setMessage(string $message, string $type = 'success'): void {
        $_SESSION['admin_mensagem'] = $message;
        $_SESSION['admin_tipo_mensagem'] = $type;
    }

    protected function requireAuth(): void {
        if (!$this->isAdminAuthenticated()) {
            $this->redirect('/admin/login');
        }
    }

    protected function requireSuperAdmin(): void {
        $this->requireAuth();
        if (!$this->isSuperAdmin()) {
            $this->setMessage('Acesso negado. Apenas super administradores podem acessar esta área.', 'error');
            $this->redirect('/admin/dashboard');
        }
    }

    public function show(): void {
        require_once __DIR__ . '/../view/admin.php';
    }
}