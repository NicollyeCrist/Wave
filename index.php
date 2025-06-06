<?php
require_once __DIR__ . '/router/Router.php';

$router = new Router();

$router->get('/', 'index.php', '', true); 

$router->get('/questoes/cadastrar', 'CadastraQuestao', 'show');
$router->get('/questoes/editar', 'EditarQuestao', 'edit');
$router->get('/questoes/deletar', 'DeletaQuestao', 'delete');

$router->get('/conteudos', 'ListarConteudos', 'list');
$router->get('/conteudos/listar', 'ListarConteudos', 'list');
$router->get('/conteudos/cadastrar', 'CadastrarConteudo', 'show');
$router->get('/conteudos/editar', 'EditarConteudo', 'edit');

$router->get('/pagina-sobre', 'sobre.php', '', true); 
$router->get('/pagina-ajuda', 'ajuda.php', '', true); 
$router->get('/em-breve', 'emBreve.php', '', true);
$router->get('/questoes', 'questoes.php', '', true);
$router->get('/questoes/assunto', 'QuestoesPorAssuntoController', 'porAssunto');
$router->get('/conteudo', 'conteudo.php', '', true);
$router->get('/login', 'LoginController', 'show');
$router->get('/register', 'RegisterUserController', 'show');
$router->get('/profile', 'profile.php', '', true);
$router->get('/logout', 'logout.php', '', true);

$router->get('/turmas', 'ListarTurmas', 'list');
$router->get('/turmas/criar', 'CriarTurma', 'show');
$router->get('/turmas/editar', 'EditarTurma', 'edit');
$router->get('/turmas/detalhes', 'GerenciarTurma', 'detalhes');

$router->get('/admin', 'AdminDashboardController', 'show');
$router->get('/admin/dashboard', 'AdminDashboardController', 'show');
$router->get('/admin/login', 'AdminLoginController', 'show');
$router->get('/admin/cadastrar', 'CadatrasAdmin', 'show');
$router->get('/admin/conteudos', 'AdminListarConteudos', 'show');
$router->get('/admin/conteudos/cadastrar', 'CadastrarConteudo', 'show');
$router->get('/admin/conteudos/editar', 'EditarConteudo', 'edit');
$router->get('/admin/questoes', 'ListarQuestoes', 'list');
$router->get('/admin/questoes/listar', 'ListarQuestoes', 'list');
$router->get('/admin/questoes/editar', 'EditarQuestao', 'edit');
$router->get('/admin/simulados', 'admin/listarSimulados.php', '', true);
$router->get('/admin/simulados/cadastrar', 'admin/cadastrarSimulado.php', '', true);
$router->get('/admin/simulados/editar', 'admin/editarSimulado.php', '', true);
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
$router->post('/admin/cadastrar', 'CadatrasAdmin', 'create');
$router->post('/admin/conteudos/cadastrar', 'CadastrarConteudo', 'create');
$router->post('/admin/conteudos/atualizar', 'EditarConteudo', 'update');
$router->post('/admin/conteudos/deletar', 'DeletarConteudo', 'delete');
$router->post('/admin/questoes/atualizar', 'AtualizaQuestao', 'update');
$router->post('/admin/simulados/cadastrar', 'controller/cadastraSimulado.php', '', true);
$router->post('/admin/simulados/atualizar', 'controller/editarSimulado.php', '', true);
$router->post('/admin/simulados/deletar', 'controller/deletarSimulado.php', '', true);
$router->post('/register', 'RegisterUserController', 'register');
$router->post('/login', 'LoginController', 'login');

$router->dispatch();
