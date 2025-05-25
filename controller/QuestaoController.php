<?php

require_once __DIR__ . '/../model/dbConnection.php';
require_once __DIR__ . '/../model/Questoes.php';
require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';

class QuestaoController
{
    private QuestoesDao $dao;

    public function __construct()
    {
        $this->dao = new QuestoesDao();
    }

    public function list(): void
    {
        header('Location: ../view/listarQuestoes.php');
        exit;
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

    public function edit(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $questao = $this->dao->readById($id);
        if (!$questao) {
            echo "Questão não encontrada.";
            exit;
        }
        require __DIR__ . '/../view/editarQuestao.php';
    }

    public function update(): void
    {
        $id = filter_input(INPUT_POST, 'idquestao', FILTER_VALIDATE_INT);
        $enunciado = filter_input(INPUT_POST, 'enunciado', FILTER_SANITIZE_STRING);
        $idconteudo = filter_input(INPUT_POST, 'idconteudo', FILTER_VALIDATE_INT);
        if ($id && $enunciado && $idconteudo) {
            $questao = new Questoes();
            $questao->setIdQuestao($id);
            $questao->setEnunciado($enunciado);
            $questao->setIdConteudo($idconteudo);
            $this->dao->update($questao);
            header('Location: ../view/listarQuestoes.php?msg=atualizada');
        } else {
            echo "Dados inválidos.";
        }
    }

    public function delete(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $this->dao->delete($id);
            header('Location: ../view/listarQuestoes.php?msg=deletada');
        } else {
            echo "ID inválido.";
        }
    }
}
