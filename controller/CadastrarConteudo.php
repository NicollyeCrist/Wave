<?php
require_once __DIR__ . '/ConteudoController.php';

class CadastrarConteudo extends ConteudoController
{    public function show(): void
    {
        session_start();

        if (!$this->isProfessor()) {
            $this->redirect('/login');
        }
        try {
            $disciplinas = $this->disciplinaDao->readAll();
            
            // DEBUG - Log das disciplinas encontradas
            error_log("CadastrarConteudo::show() - Disciplinas encontradas: " . count($disciplinas));
            foreach ($disciplinas as $disciplina) {
                error_log("Disciplina ID: " . $disciplina['id'] . " - Nome: " . $disciplina['nome']);
            }
            
            $data = ['disciplinas' => $disciplinas];
            $this->render('cadastraConteudo', $data);
        } catch (Exception $e) {
            error_log("CadastrarConteudo::show() - Erro: " . $e->getMessage());
            $this->setMessage('Erro ao carregar formulário: ' . $e->getMessage(), 'error');
            $this->render('cadastraConteudo', ['disciplinas' => []]);
        }
    }

    public function create(): void
    {
        session_start();

        if (!$this->isProfessor()) {
            $this->redirect('/login');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/conteudos/cadastrar');
        }

        try {
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
            $idDisciplina = filter_input(INPUT_POST, 'id_disciplina', FILTER_VALIDATE_INT);

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

                $resultado = $this->conteudoDao->create($conteudo);

                if ($resultado) {
                    $this->setMessage("Conteúdo cadastrado com sucesso!", "success");
                } else {
                    $this->setMessage("Erro ao cadastrar conteúdo.", "error");
                }
            } else {
                $this->setMessage("Dados inválidos. Verifique o título e a disciplina.", "error");
            }
        } catch (Exception $e) {
            $this->setMessage("Erro interno: " . $e->getMessage(), "error");
        }

        $this->redirect('/conteudos/cadastrar');
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
