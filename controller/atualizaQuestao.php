<?php
require_once __DIR__ . '/QuestaoController.php';
require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';
require_once __DIR__ . '/../model/Questoes.php';
require_once __DIR__ . '/../model/dbConnection.php';
class AtualizaQuestao extends QuestaoController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function update(): void
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $enunciado = filter_input(INPUT_POST, 'enunciado', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_conteudo = filter_input(INPUT_POST, 'id_conteudo', FILTER_VALIDATE_INT);
        $alternativas = filter_input(INPUT_POST, 'alternativas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $correta = filter_input(INPUT_POST, 'correta'); // Recebe o id da alternativa correta como string

        // Debug
        var_dump([
            'id' => $id,
            'enunciado' => $enunciado,
            'id_conteudo' => $id_conteudo,
            'alternativas' => $alternativas,
            'correta' => $correta
        ]);

        if ($id && $enunciado && $id_conteudo && $alternativas && $correta !== null) {
            try {
                $conn = DbConnection::getConn();
                $conn->beginTransaction();

                // Update questão
                $questao = new Questoes();
                $questao->setId($id);
                $questao->setEnunciado($enunciado);
                $questao->setIdConteudo($id_conteudo);
                $this->dao->update($questao);

                // Update alternativas
                $alternativaDao = new AlternativaDao();
                foreach ($alternativas as $altId => $texto) {
                    if (strpos($altId, 'new_') === 0) {
                        // Nova alternativa
                        $alternativaDao->create($id, $texto, $altId == $correta);
                    } else {
                        // Alternativa existente
                        $alternativaDao->update((int)$altId, $texto, $altId == $correta);
                    }
                }

                $conn->commit();
                header('Location: /mesominds/questoes/listar?msg=atualizada');
                exit;
            } catch (PDOException $e) {
                $conn->rollBack();
                echo "Erro ao atualizar: " . $e->getMessage();
            }
        } else {
            echo "Dados inválidos. Verifique:<br>";
            if (!$id) echo "- ID não fornecido<br>";
            if (!$enunciado) echo "- Enunciado não preenchido<br>";
            if (!$id_conteudo) echo "- Conteúdo não selecionado<br>";
            if (!$alternativas) echo "- Alternativas não preenchidas<br>";
            if ($correta === null) echo "- Alternativa correta não selecionada<br>";
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