<?php
require_once __DIR__ . '/QuestaoController.php';
require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';
require_once __DIR__ . '/../model/Questoes.php';
require_once __DIR__ . '/../model/dbConnection.php';
class CadastraQuestao extends QuestaoController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create(): void
    {
        $enunciado = filter_input(INPUT_POST, 'enunciado', FILTER_SANITIZE_STRING);
        $idconteudo = filter_input(INPUT_POST, 'idconteudo', FILTER_VALIDATE_INT);
        $alternativas = filter_input(INPUT_POST, 'alternativas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $correta = filter_input(INPUT_POST, 'correta', FILTER_VALIDATE_INT);

        if ($enunciado && $idconteudo && $alternativas && $correta !== null) {
            $questao = new Questoes();
            $questao->setEnunciado($enunciado);
            $questao->setIdConteudo($idconteudo);

            try {
                $this->dao->create($questao);
                $idQuestao = DbConnection::getConn()->lastInsertId();
                $alternativaDao = new AlternativaDao();
                foreach ($alternativas as $index => $texto) {
                    $alternativaDao->create($idQuestao, $texto, $index == $correta);
                }
                header('Location: ../view/listarQuestoes.php?msg=criada');
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
        } else {
            echo "Dados inválidos.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ctrl = new CadastraQuestao();
    $ctrl->create();
}
?>