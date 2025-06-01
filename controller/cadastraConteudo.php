<?php

require_once '../model/Conteudo.php';
require_once '../model/ConteudoDao.php';

$titulo = filter_input(INPUT_POST, 'tituloConteudo', FILTER_SANITIZE_SPECIAL_CHARS);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
$linkconteudo = filter_input(INPUT_POST, 'linkconteudo', FILTER_SANITIZE_SPECIAL_CHARS);



if ($titulo) {
    $conteudo = new Conteudo();
    $conteudo->setTitulo($titulo);
    $conteudo->setDescricao($descricao);
    $conteudo->setlinkconteudo($linkconteudo);

    $dao = new ConteudoDao();
    $dao->create($conteudo);

    echo "Conteúdo salvo com sucesso!";
} else {
    echo "titulo inválido.";
}