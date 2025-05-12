<?php
require_once '../model/Questoes.php';
require_once '../model/QuestoesDao.php';

$enunciado = filter_input(INPUT_POST, 'enunciado', FILTER_SANITIZE_STRING);
$idconteudo = filter_input(INPUT_POST, 'idconteudo', FILTER_VALIDATE_INT);

if ($enunciado && $idconteudo) {
    $questao = new Questoes();
    $questao->setEnunciado($enunciado);
    $questao->setIdConteudo($idconteudo);

    $dao = new QuestoesDao();
    try {
        $dao->create($questao);
        echo "Questão cadastrada com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar questão: " . $e->getMessage();
    }
} else {
    echo "Enunciado ou conteúdo inválido.";
}

?>
