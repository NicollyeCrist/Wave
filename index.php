<?php
require_once __DIR__ . '/router/Router.php';

$router = new Router();

$router->get('/', 'index.php', '', true); 

$router->get('/questoes/listar', 'ListarQuestoes', 'list');
$router->get('/questoes/cadastrar', 'ExibirCadastroQuestao', 'show');
$router->get('/questoes/editar', 'EditarQuestao', 'edit');
$router->get('/questoes/deletar', 'DeletaQuestao', 'delete');

$router->get('/conteudos', 'ListarConteudos', 'list');
$router->get('/conteudos/listar', 'ListarConteudos', 'list');
$router->get('/conteudos/cadastrar', 'CadastrarConteudo', 'show');
$router->get('/conteudos/editar', 'EditarConteudo', 'edit');

$router->get('/pagina-sobre', 'sobre.php', '', true); 
$router->get('/pagina-ajuda', 'ajuda.php', '', true); 
$router->get('/questoes', 'questoes.php', '', true);
$router->get('/conteudo', 'conteudo.php', '', true);
$router->get('/login', 'login.php', '', true);
$router->get('/register', 'register.php', '', true);
$router->get('/profile', 'profile.php', '', true);
$router->get('/logout', 'logout.php', '', true);

$router->get('/turmas', 'ListarTurmas', 'list');
$router->get('/turmas/criar', 'CriarTurma', 'show');
$router->get('/turmas/editar', 'EditarTurma', 'edit');
$router->get('/turmas/detalhes', 'GerenciarTurma', 'detalhes');

$router->get('/admin', 'AdminDashboardController', 'show');
$router->get('/admin/dashboard', 'AdminDashboardController', 'show');
$router->get('/admin/login', 'AdminLoginController', 'show');
$router->get('/admin/cadastrar', 'CadatraAdmin', 'show');
$router->get('/admin/conteudos', 'AdminListarConteudos', 'show');
$router->get('/admin/conteudos/cadastrar', 'CadastrarConteudo', 'show');
$router->get('/admin/conteudos/editar', 'EditarConteudo', 'edit');
$router->get('/admin/logout', 'AdminLoginController', 'logout');


$router->post('/questoes/criar', 'CadastraQuestao', 'create');
$router->post('/questoes/atualizar', 'AtualizaQuestao', 'update');
$router->post('/questoes/deletar', 'DeletaQuestao', 'delete');

$router->post('/conteudos/cadastrar', 'CadastrarConteudo', 'create');
$router->post('/conteudos/atualizar', 'EditarConteudo', 'update');
$router->post('/conteudos/deletar', 'DeletarConteudo', 'delete');

$router->post('/turmas/criar', 'CriarTurma', 'create');
$router->post('/turmas/atualizar', 'EditarTurma', 'update');
$router->post('/turmas/deletar', 'DeletarTurma', 'delete');
$router->post('/turmas/entrar', 'GerenciarTurma', 'entrar');
$router->post('/turmas/sair', 'GerenciarTurma', 'sair');

$router->post('/admin/login', 'AdminLoginController', 'login');
$router->post('/admin/cadastrar', 'CadatraAdmin', 'create');
$router->post('/admin/conteudos/cadastrar', 'CadastrarConteudo', 'create');
$router->post('/admin/conteudos/atualizar', 'EditarConteudo', 'update');
$router->post('/admin/conteudos/deletar', 'DeletarConteudo', 'delete');
$router->post('/register', 'RegisterUserController', 'register');
$router->post('/login', 'LoginController', 'login');

$router->dispatch();
