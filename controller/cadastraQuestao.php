<?php
require_once '../model/Questoes.php';
require_once '../model/QuestoesDao.php';
require_once '../model/AlternativaDao.php';

$enunciado = filter_input(INPUT_POST, 'enunciado', FILTER_SANITIZE_STRING);
$idconteudo = filter_input(INPUT_POST, 'idconteudo', FILTER_VALIDATE_INT);
$alternativas = filter_input(INPUT_POST, 'alternativas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$correta = filter_input(INPUT_POST, 'correta', FILTER_VALIDATE_INT);

if ($enunciado && $idconteudo && $alternativas && $correta !== null) {
    $questao = new Questoes();
    $questao->setEnunciado($enunciado);
    $questao->setIdConteudo($idconteudo);

    $questoesDao = new QuestoesDao();
    $alternativaDao = new AlternativaDao();

    try {
        $questoesDao->create($questao);
        $idQuestao = DbConnection::getConn()->lastInsertId();

        foreach ($alternativas as $index => $texto) {
            $alternativaDao->create($idQuestao, $texto, $index == $correta);
        }

        echo "Questão e alternativas cadastradas com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar questão: " . $e->getMessage();
    }
} else {
    echo "Dados inválidos.";
}
?>
