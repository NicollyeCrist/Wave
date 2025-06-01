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
    }    public function create(): void
    {
        $enunciado = filter_input(INPUT_POST, 'enunciado', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_conteudo = filter_input(INPUT_POST, 'id_conteudo', FILTER_VALIDATE_INT);
        $alternativas = filter_input(INPUT_POST, 'alternativas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $correta = filter_input(INPUT_POST, 'correta', FILTER_VALIDATE_INT);

        if (!isset($_POST['id_conteudo'])) {
            die("Erro: Campo 'id_conteudo' não está presente no formulário");
        }

        if ($id_conteudo === false || $id_conteudo === null) {
            die("Erro: ID do conteúdo inválido. Certifique-se de selecionar um conteúdo válido.");
        }

        if ($enunciado && $id_conteudo && $alternativas && $correta !== null) {
            $questao = new Questoes();
            $questao->setEnunciado($enunciado);
            $questao->setIdConteudo($id_conteudo);

            try {
                $this->dao->create($questao);
                $idQuestao = DbConnection::getConn()->lastInsertId();
                $alternativaDao = new AlternativaDao();
                foreach ($alternativas as $index => $texto) {
                    $alternativaDao->create($idQuestao, $texto, $index == $correta);
                }
                header('Location: ../controller/listarQuestoes.php?msg=criada');
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
        } else {
            echo "Dados inválidos. Verifique:<br>";
            if (!$enunciado) echo "- Enunciado não preenchido<br>";
            if (!$id_conteudo) echo "- Conteúdo não selecionado<br>";
            if (!$alternativas) echo "- Alternativas não preenchidas<br>";
            if ($correta === null) echo "- Alternativa correta não selecionada<br>";
        }
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

    public function list(): void
    {
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ctrl = new CadastraQuestao();
    $ctrl->create();
}
?>