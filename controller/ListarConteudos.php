<?php

session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: /mesominds/login");
    exit;
}

require_once '../model/ConteudoDao.php';
require_once '../model/DisciplinaDao.php';

$conteudoDao = new ConteudoDao();
$disciplinaDao = new DisciplinaDao();

// Filtrar por disciplina se especificado
$idDisciplina = filter_input(INPUT_GET, 'disciplina', FILTER_VALIDATE_INT);
$disciplinaSelecionada = null;

if ($idDisciplina) {
    $conteudos = $conteudoDao->findByDisciplina($idDisciplina);
    $disciplinaSelecionada = $disciplinaDao->findById($idDisciplina);
} else {
    $conteudos = $conteudoDao->readAll();
}

$disciplinas = $disciplinaDao->readAll();

include '../view/listarConteudos.php';

?>
