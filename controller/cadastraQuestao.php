<?php
require_once __DIR__ . '/adminController.php';
require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';
require_once __DIR__ . '/../model/Questoes.php';
require_once __DIR__ . '/../model/dbConnection.php';
class CadastraQuestao extends AdminController
{
    public function show(): void
    {
        session_start();

        if (!$this->isAdminAuthenticated()) {
            $this->redirect('/admin/login');
        }
        
        try {
            $conteudos = $this->ConteudoDao->readAll();
            
            $data = ['conteudos' => $conteudos];
            $this->render('CadastraQuestao', $data);
        } catch (Exception $e) {
            error_log("CadastraQuestao::show() - Erro: " . $e->getMessage());
            $this->setMessage('Erro ao carregar formulário: ' . $e->getMessage(), 'error');
            $this->render('CadastraQuestao', ['conteudos' => []]);
        }
    }
    public function __construct()
    {
        parent::__construct();
    }    public function create(): void
    {
        session_start();
        
        if (!$this->isAdminAuthenticated()) {
            $this->redirect('/admin/login');
        }

        $enunciado = filter_input(INPUT_POST, 'enunciado', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_conteudo = filter_input(INPUT_POST, 'id_conteudo', FILTER_VALIDATE_INT);
        $alternativas = filter_input(INPUT_POST, 'alternativas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $correta = filter_input(INPUT_POST, 'correta', FILTER_VALIDATE_INT);

        if (!isset($_POST['id_conteudo'])) {
            $this->setMessage("Erro: Campo 'id_conteudo' não está presente no formulário", 'error');
            $this->redirect('/questoes/cadastrar');
            return;
        }

        if ($id_conteudo === false || $id_conteudo === null) {
            $this->setMessage("Erro: ID do conteúdo inválido. Certifique-se de selecionar um conteúdo válido.", 'error');
            $this->redirect('/questoes/cadastrar');
            return;
        }

        if ($enunciado && $id_conteudo && $alternativas && $correta !== null) {
            $questao = new Questoes();
            $questao->setEnunciado($enunciado);
            $questao->setIdConteudo($id_conteudo);

            try {
                $questoesDao = new QuestoesDao();
                $questoesDao->create($questao);
                $idQuestao = DbConnection::getConn()->lastInsertId();
                
                $alternativaDao = new AlternativaDao();
                foreach ($alternativas as $index => $texto) {
                    $alternativaDao->create($idQuestao, $texto, $index == $correta);
                }
                
                $this->setMessage('Questão cadastrada com sucesso!', 'success');
                $this->redirect('/mesominds/questoes/listar');
            } catch (PDOException $e) {
                error_log("Erro ao cadastrar questão: " . $e->getMessage());
                $this->setMessage('Erro ao cadastrar questão: ' . $e->getMessage(), 'error');
                $this->redirect('/questoes/cadastrar');
            }
        } else {
            $errors = [];
            if (!$enunciado) $errors[] = "Enunciado não preenchido";
            if (!$id_conteudo) $errors[] = "Conteúdo não selecionado";
            if (!$alternativas) $errors[] = "Alternativas não preenchidas";
            if ($correta === null) $errors[] = "Alternativa correta não selecionada";
            
            $this->setMessage('Dados inválidos: ' . implode(', ', $errors), 'error');
            $this->redirect('/questoes/cadastrar');
        }
    }

    public function edit(): void
    {
    }

    public function update(): void
    {
    }    public function delete(): void
    {
    }

    public function list(): void
    {
    }
}
?>