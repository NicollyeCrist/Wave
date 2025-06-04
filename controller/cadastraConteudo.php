<?php

session_start();

// Verificar se o usuário está logado e é professor
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario'] !== 'professor') {
    header("Location: /mesominds/login");
    exit;
}

require_once '../model/Conteudo.php';
require_once '../model/ConteudoDao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
    $idDisciplina = filter_input(INPUT_POST, 'id_disciplina', FILTER_VALIDATE_INT);
    
    // Processar links (podem ser múltiplos)
    $links = [];
    $linkTitulos = $_POST['link_titulo'] ?? [];
    $linkUrls = $_POST['link_url'] ?? [];
    
    for ($i = 0; $i < count($linkTitulos); $i++) {
        if (!empty($linkTitulos[$i]) && !empty($linkUrls[$i])) {
            $links[] = [
                'titulo' => filter_var($linkTitulos[$i], FILTER_SANITIZE_SPECIAL_CHARS),
                'url' => filter_var($linkUrls[$i], FILTER_SANITIZE_URL)
            ];
        }
    }

    if ($titulo && $idDisciplina) {
        $conteudo = new Conteudo();
        $conteudo->setTitulo($titulo);
        $conteudo->setDescricao($descricao);
        $conteudo->setIdDisciplina($idDisciplina);
        $conteudo->setLinks($links);

        $dao = new ConteudoDao();
        $resultado = $dao->create($conteudo);
        
        if ($resultado) {
            $_SESSION['mensagem'] = "Conteúdo cadastrado com sucesso!";
            $_SESSION['tipo_mensagem'] = "success";
        } else {
            $_SESSION['mensagem'] = "Erro ao cadastrar conteúdo.";
            $_SESSION['tipo_mensagem'] = "error";
        }
    } else {
        $_SESSION['mensagem'] = "Dados inválidos. Verifique o título e a disciplina.";
        $_SESSION['tipo_mensagem'] = "error";
    }
    
    header("Location: /mesominds/conteudos/cadastrar");
    exit;
}

// Se chegou aqui, é GET - mostrar o formulário
require_once '../model/DisciplinaDao.php';
$disciplinaDao = new DisciplinaDao();
$disciplinas = $disciplinaDao->readAll();

include '../view/cadastraConteudo.php';

?>