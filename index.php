<?php
require_once __DIR__ . '/router/Router.php';

$router = new Router();

// Admin route should be first
$router->get('/', 'index.php', '', true); // carrega view/admin.php diretamente

// Other routes
$router->get('/questoes/listar', 'ListarQuestoes', 'list');
$router->get('/questoes/cadastrar', 'ExibirCadastroQuestao', 'show');
$router->get('/questoes/editar', 'EditarQuestao', 'edit');
$router->get('/conteudos/listar', 'ListarConteudos', 'list');
$router->get('/conteudos/cadastrar', 'CadastraConteudo', 'show');
$router->get('/questoes/deletar', 'DeletaQuestao', 'delete');
$router->get('/pagina-sobre', 'sobre.php', '', true); 
$router->get('/pagina-ajuda', 'ajuda.php', '', true); 
$router->get('/questoes', 'questoes.php', '', true);
$router->get('/conteudos', 'conteudo.php', '', true);


$router->post('/questoes/criar', 'CadastraQuestao', 'create');
$router->post('/questoes/atualizar', 'AtualizaQuestao', 'update');
$router->post('/questoes/deletar', 'DeletaQuestao', 'delete');
$router->post('/conteudos/criar', 'CadastraConteudo', 'create');

$router->dispatch();
