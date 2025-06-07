<?php
require_once __DIR__ . '/adminController.php';
require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';
require_once __DIR__ . '/../model/Questoes.php';
require_once __DIR__ . '/../model/dbConnection.php';

class DeletaQuestao extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function delete(): void
    {
        session_start();
        
        if (!$this->isAdminAuthenticated()) {
            $this->redirect('/admin/login');
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if ($id !== false && $id !== null) {
            try {
                $conn = DbConnection::getConn();
                
                if (!$conn->inTransaction()) {
                    $conn->beginTransaction();
                }
                
                $alternativaDao = new AlternativaDao();
                $alternativaDao->deleteByQuestaoId($id);
                
                $questoesDao = new QuestoesDao();
                $questoesDao->delete($id);
                  $conn->commit();
                $this->setMessage('Questão deletada com sucesso!', 'success');
                $this->redirect('/admin/questoes');
                exit;} catch (PDOException $e) {
                if ($conn->inTransaction()) {
                    $conn->rollBack();
                }                error_log("Erro ao deletar questão: " . $e->getMessage());
                $this->setMessage('Erro ao deletar questão: ' . $e->getMessage(), 'error');
                $this->redirect('/admin/questoes');
            }
        } else {
            $this->setMessage('ID inválido fornecido.', 'error');
            $this->redirect('/admin/questoes');
        }
    }

    public function show(): void
    {
        $this->redirect('/admin/questoes');
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
