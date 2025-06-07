<?php
require_once '../model/SimuladoDao.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    $questoesSelecionadas = $_POST['questoes'] ?? [];

    if ($titulo && $status && count($questoesSelecionadas) > 0) {
        $simuladoDao = new SimuladoDao();
        try {
            $simuladoDao->create($titulo, $descricao, $status, $questoesSelecionadas);
            $msg = 'Simulado cadastrado com sucesso!';
        } catch (PDOException $e) {
            $msg = 'Erro ao cadastrar simulado: ' . $e->getMessage();
        }
    } else {
        $msg = 'Preencha todos os campos e selecione pelo menos uma questão.';
    }
}
header('Location: ../view/cadastraSimulado.php?msg=' . urlencode($msg));
exit;
