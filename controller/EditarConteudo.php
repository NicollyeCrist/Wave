<?php
require_once __DIR__ . '/AdminController.php';

class EditarConteudo extends AdminController
{
    public function __construct()
    {
        parent::__construct();

    }
    public function edit(): void
    {
        session_start();

        if (!$this->isAdminAuthenticated()) {
            $this->redirect('/login');
        }

        try {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (!$id) {
                $this->setMessage('ID do conteúdo inválido.', 'error');
                $this->redirect('/conteudos');
            }

            $conteudo = $this->ConteudoDao->findById($id);
            if (!$conteudo) {
                $this->setMessage('Conteúdo não encontrado.', 'error');
                $this->redirect('/conteudos');
            }

            $disciplinas = $this->DisciplinaDao->readAll();

            $data = [
                'conteudo' => $conteudo,
                'disciplinas' => $disciplinas
            ];

            $this->render('editarConteudo', $data);
        } catch (Exception $e) {
            $this->setMessage('Erro ao carregar conteúdo: ' . $e->getMessage(), 'error');
            $this->redirect('/conteudos');
        }
    }

    public function update(): void
    {
        session_start();

        if (!$this->isAdminAuthenticated()) {
            $this->redirect('/login');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/conteudos');
        }

        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
            $idDisciplina = filter_input(INPUT_POST, 'id_disciplina', FILTER_VALIDATE_INT);

            if (!$id) {
                $this->setMessage('ID do conteúdo inválido.', 'error');
                $this->redirect('/conteudos');
            }
            $conteudo = $this->ConteudoDao->findById($id);
            if (!$conteudo) {
                $this->setMessage('Conteúdo não encontrado.', 'error');
                $this->redirect('/conteudos');
            }

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
                $conteudo->setTitulo($titulo);
                $conteudo->setDescricao($descricao);
                $conteudo->setIdDisciplina($idDisciplina);
                $conteudo->setLinks($links);

                $resultado = $this->ConteudoDao->update($conteudo);

                if ($resultado) {
                    $this->setMessage("Conteúdo atualizado com sucesso!", "success");
                } else {
                    $this->setMessage("Erro ao atualizar conteúdo.", "error");
                }
            } else {
                $this->setMessage("Dados inválidos. Verifique o título e a disciplina.", "error");
            }
        } catch (Exception $e) {
            $this->setMessage("Erro interno: " . $e->getMessage(), "error");
        }

        $this->redirect('/conteudos');
    }

    public function list(): void
    {
        $this->redirect('/conteudos');
    }

    public function create(): void
    {
        $this->redirect('/conteudos/cadastrar');
    }

    public function show(): void
    {
        $this->edit();
    }

    public function delete(): void
    {
    }
}
