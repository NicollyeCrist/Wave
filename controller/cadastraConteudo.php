<?php

require_once '../model/Conteudo.php';
require_once '../model/ConteudoDao.php';

$titulo = filter_input(INPUT_POST, 'tituloConteudo', FILTER_SANITIZE_STRING);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
$linkconteudo = filter_input(INPUT_POST, 'linkconteudo', FILTER_SANITIZE_STRING);



if ($titulo) {
    $conteudo = new Conteudo();
    $conteudo->setTitulo($titulo);
    $conteudo->setDecricao($descricao);
    $conteudo->setlinkconteudo($linkconteudo);

    $dao = new ConteudoDao();
    $dao->create($conteudo);

    echo "Conteúdo salvo com sucesso!";
} else {
    echo "titulo inválido.";
}