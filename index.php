<?php
require_once __DIR__ . '/router/Router.php';

$router = new Router();

$router->get('/', 'index.php', '', true); 

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
$router->get('/login', 'login.php', '', true);
$router->get('/register', 'register.php', '', true);
$router->get('/profile', 'profile.php', '', true);
$router->get('/logout', 'logout.php', '', true);

$router->get('/turmas', 'ListarTurmas', 'list');
$router->get('/turmas/criar', 'CriarTurma', 'show');
$router->get('/turmas/editar', 'EditarTurma', 'edit');
$router->get('/turmas/detalhes', 'GerenciarTurma', 'detalhes');

$router->post('/questoes/criar', 'CadastraQuestao', 'create');
$router->post('/questoes/atualizar', 'AtualizaQuestao', 'update');
$router->post('/questoes/deletar', 'DeletaQuestao', 'delete');
$router->post('/conteudos/criar', 'CadastraConteudo', 'create');

$router->post('/turmas/criar', 'CriarTurma', 'create');
$router->post('/turmas/atualizar', 'EditarTurma', 'update');
$router->post('/turmas/deletar', 'DeletarTurma', 'delete');
$router->post('/turmas/entrar', 'GerenciarTurma', 'entrar');
$router->post('/turmas/sair', 'GerenciarTurma', 'sair');

$router->dispatch();
