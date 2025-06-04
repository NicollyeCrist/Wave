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
        
        if ($id !== false && $id !== null) {
            try {
                $conn = DbConnection::getConn();
                
                if (!$conn->inTransaction()) {
                    $conn->beginTransaction();
                }
                
                $alternativaDao = new AlternativaDao();
                $alternativaDao->deleteByQuestaoId($id);
                $this->dao->delete($id);
                
                $conn->commit();
                header('Location: /mesominds/questoes/listar?msg=deletada');
                exit;
            } catch (PDOException $e) {
                if ($conn->inTransaction()) {
                    $conn->rollBack();
                }
                echo "Erro ao deletar questão: " . $e->getMessage();
            }
        } else {
            header('Location: /mesominds/questoes/listar?msg=erro');
            exit;
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
