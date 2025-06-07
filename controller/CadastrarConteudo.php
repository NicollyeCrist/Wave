<?php
require_once __DIR__ . '/adminController.php';

class CadastrarConteudo extends AdminController
{
    public function __construct()
    {
        parent::__construct();

    }
    public function show(): void
    {
        session_start();

        if (!$this->isAdminAuthenticated()) {
            $this->redirect('/admin/login');
        }
        try {
            $disciplinas = $this->DisciplinaDao->readAll();

            foreach ($disciplinas as $disciplina) {
                error_log("Disciplina ID: " . $disciplina['id'] . " - Nome: " . $disciplina['nome']);
            }

            $data = ['disciplinas' => $disciplinas];
            $this->render('admin/cadastrarConteudo', $data);
        } catch (Exception $e) {
            error_log("CadastrarConteudo::show() - Erro: " . $e->getMessage());
            $this->setMessage('Erro ao carregar formulário: ' . $e->getMessage(), 'error');
            $this->render('admin/cadastrarConteudo', ['disciplinas' => []]);
        }
    }
    public function create(): void
    {
        session_start();

        if (!$this->isAdminAuthenticated()) {
            $this->redirect('/admin/login');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/conteudos/cadastrar');
        }

        try {
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
            $idDisciplina = filter_input(INPUT_POST, 'id_disciplina', FILTER_VALIDATE_INT);
            $links = [];
            $linksArray = $_POST['links'] ?? [];

            foreach ($linksArray as $link) {
                if (!empty($link) && filter_var($link, FILTER_VALIDATE_URL)) {
                    $links[] = filter_var($link, FILTER_SANITIZE_URL);
                }
            }

            if ($titulo && $idDisciplina) {
                $conteudo = new Conteudo();
                $conteudo->setTitulo($titulo);
                $conteudo->setDescricao($descricao);
                $conteudo->setIdDisciplina($idDisciplina);
                $conteudo->setLinks($links);

                $resultado = $this->ConteudoDao->create($conteudo);
                if ($resultado) {
                    $this->setMessage("Conteúdo cadastrado com sucesso!", "success");
                    $this->redirect('/admin/conteudos');
                } else {
                    $this->setMessage("Erro ao cadastrar conteúdo.", "error");
                    $this->redirect('/admin/conteudos/cadastrar');
                }
            } else {
                $this->setMessage("Dados inválidos. Verifique o título e a disciplina.", "error");
                $this->redirect('/admin/conteudos/cadastrar');
            }
        } catch (Exception $e) {
            $this->setMessage("Erro interno: " . $e->getMessage(), "error");
            $this->redirect('/admin/conteudos/cadastrar');
        }
    }

    public function list(): void
    {
        $this->redirect('/conteudos');
    }

    public function edit(): void
    {
    }

    public function update(): void
    {
    }

    public function delete(): void
    {
    }
}
