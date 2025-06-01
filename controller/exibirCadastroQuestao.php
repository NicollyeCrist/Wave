<?php

require_once __DIR__ . '/../model/ConteudoDao.php';
require_once __DIR__ . '/../model/Conteudo.php'; 

$conteudoDao = new ConteudoDao();
$conteudos = $conteudoDao->readAll();

require_once __DIR__ . '/../view/cadastraQuestao.php';

?>