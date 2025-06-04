<?php
require_once __DIR__ . '/adminController.php';
require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';
require_once __DIR__ . '/../model/Questoes.php';
require_once __DIR__ . '/../model/dbConnection.php';
class AtualizaQuestao extends AdminController
{
    private $dao;

    public function __construct()
    {
        parent::__construct();
        $this->dao = new QuestoesDao();
    }

    public function show(): void
    {
        // This method is required by AdminController but not used for updates
        if (!$this->isAdminAuthenticated()) {
            header('Location: /mesominds/admin/login');
            exit;
        }
    }    public function update(): void
    {
        if (!$this->isAdminAuthenticated()) {
            header('Location: /mesominds/admin/login');
            exit;
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $enunciado = filter_input(INPUT_POST, 'enunciado', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_conteudo = filter_input(INPUT_POST, 'id_conteudo', FILTER_VALIDATE_INT);
        $alternativas = filter_input(INPUT_POST, 'alternativas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $correta = filter_input(INPUT_POST, 'correta'); // Recebe o id da alternativa correta como string

        if ($id && $enunciado && $id_conteudo && $alternativas && $correta !== null) {
            try {
                $conn = DbConnection::getConn();
                $conn->beginTransaction();

                $questao = new Questoes();
                $questao->setId($id);
                $questao->setEnunciado($enunciado);
                $questao->setIdConteudo($id_conteudo);
                $this->dao->update($questao);

                $alternativaDao = new AlternativaDao();
                foreach ($alternativas as $altId => $texto) {
                    if (strpos($altId, 'new_') === 0) {
                        $alternativaDao->create($id, $texto, $altId == $correta);
                    } else {
                        $alternativaDao->update((int)$altId, $texto, $altId == $correta);
                    }
                }

                $conn->commit();
                $this->setMessage('Questão atualizada com sucesso!', 'success');
                header('Location: /mesominds/admin/questoes');
                exit;
            } catch (PDOException $e) {
                $conn->rollBack();
                $this->setMessage('Erro ao atualizar questão: ' . $e->getMessage(), 'error');
                header('Location: /mesominds/admin/questoes');
                exit;
            }
        } else {
            $errors = [];
            if (!$id) $errors[] = 'ID não fornecido';
            if (!$enunciado) $errors[] = 'Enunciado não preenchido';
            if (!$id_conteudo) $errors[] = 'Conteúdo não selecionado';
            if (!$alternativas) $errors[] = 'Alternativas não preenchidas';
            if ($correta === null) $errors[] = 'Alternativa correta não selecionada';
            
            $this->setMessage('Dados inválidos: ' . implode(', ', $errors), 'error');
            header('Location: /mesominds/admin/questoes');
            exit;
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