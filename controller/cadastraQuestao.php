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
            $this->render('admin/cadastrarQuestao', $data);
        } catch (Exception $e) {
            error_log("CadastraQuestao::show() - Erro: " . $e->getMessage());
            $this->setMessage('Erro ao carregar formulário: ' . $e->getMessage(), 'error');
            $this->render('admin/cadastrarQuestao', ['conteudos' => []]);
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

        try {
            if (isset($_POST['questoes']) && is_array($_POST['questoes'])) {
                $this->createMultipleQuestoes();
            } else {
                $this->createSingleQuestao();
            }
        } catch (Exception $e) {
            error_log("Erro ao cadastrar questão(ões): " . $e->getMessage());
            $this->setMessage('Erro interno. Tente novamente.', 'error');
            $this->redirect('/admin/questoes/cadastrar');
        }
    }

    private function createMultipleQuestoes(): void
    {
        $questoes = $_POST['questoes'];
        $successCount = 0;
        $errors = [];

        foreach ($questoes as $index => $questaoData) {
            try {
                $enunciado = filter_var($questaoData['enunciado'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
                $id_conteudo = filter_var($questaoData['id_conteudo'] ?? 0, FILTER_VALIDATE_INT);
                $nivel_dificuldade = filter_var($questaoData['nivel_dificuldade'] ?? 0, FILTER_VALIDATE_INT);
                $alternativas = $questaoData['alternativas'] ?? [];
                $correta = filter_var($questaoData['correta'] ?? null, FILTER_VALIDATE_INT);
                $correcao = filter_var($questaoData['correcao'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

                if (empty($enunciado)) {
                    $errors[] = "Questão {$index}: Enunciado é obrigatório";
                    continue;
                }

                if (!$id_conteudo) {
                    $errors[] = "Questão {$index}: Conteúdo deve ser selecionado";
                    continue;
                }

                if (!$nivel_dificuldade || !in_array($nivel_dificuldade, [1, 2, 3])) {
                    $errors[] = "Questão {$index}: Nível de dificuldade inválido";
                    continue;
                }                if (count($alternativas) < 2) {
                    $errors[] = "Questão {$index}: Deve ter pelo menos 2 alternativas";
                    continue;
                }

                if ($correta === null || $correta < 0 || $correta >= count($alternativas)) {
                    $errors[] = "Questão {$index}: Alternativa correta deve ser selecionada e válida";
                    continue;
                }

                $alternativasVazias = false;
                foreach ($alternativas as $alt) {
                    if (empty(trim($alt))) {
                        $alternativasVazias = true;
                        break;
                    }
                }

                if ($alternativasVazias) {
                    $errors[] = "Questão {$index}: Todas as alternativas devem ser preenchidas";
                    continue;
                }

                $questao = new Questoes();
                $questao->setEnunciado($enunciado);
                $questao->setIdConteudo($id_conteudo);
                $questao->setNivelDificuldade($nivel_dificuldade);
                if (!empty($correcao)) {
                    $questao->setCorrecao($correcao);
                }

                $questoesDao = new QuestoesDao();
                $questoesDao->create($questao);
                $idQuestao = DbConnection::getConn()->lastInsertId();

                $alternativaDao = new AlternativaDao();
                foreach ($alternativas as $altIndex => $texto) {
                    $alternativaDao->create($idQuestao, trim($texto), $altIndex == $correta);
                }

                $successCount++;

            } catch (Exception $e) {
                $errors[] = "Questão {$index}: " . $e->getMessage();
            }
        }

        if ($successCount > 0) {
            $message = "{$successCount} questão(ões) cadastrada(s) com sucesso!";
            if (!empty($errors)) {
                $message .= " Alguns erros ocorreram: " . implode('; ', $errors);
                $this->setMessage($message, 'warning');
            } else {
                $this->setMessage($message, 'success');
            }
        } else {
            $this->setMessage('Nenhuma questão foi cadastrada. Erros: ' . implode('; ', $errors), 'error');
        }

        $this->redirect('/admin/questoes');
    }

    private function createSingleQuestao(): void
    {
        $enunciado = filter_input(INPUT_POST, 'enunciado', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_conteudo = filter_input(INPUT_POST, 'id_conteudo', FILTER_VALIDATE_INT);
        $alternativas = filter_input(INPUT_POST, 'alternativas', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $correta = filter_input(INPUT_POST, 'correta', FILTER_VALIDATE_INT);

        if (!isset($_POST['id_conteudo'])) {
            $this->setMessage("Erro: Campo 'id_conteudo' não está presente no formulário", 'error');
            $this->redirect('/admin/questoes/cadastrar');
            return;
        }

        if ($id_conteudo === false || $id_conteudo === null) {
            $this->setMessage("Erro: ID do conteúdo inválido. Certifique-se de selecionar um conteúdo válido.", 'error');
            $this->redirect('/admin/questoes/cadastrar');
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
                $this->redirect('/admin/questoes');
            } catch (PDOException $e) {
                error_log("Erro ao cadastrar questão: " . $e->getMessage());
                $this->setMessage('Erro ao cadastrar questão: ' . $e->getMessage(), 'error');
                $this->redirect('/admin/questoes/cadastrar');
            }
        } else {
            $errors = [];
            if (!$enunciado) $errors[] = "Enunciado não preenchido";
            if (!$id_conteudo) $errors[] = "Conteúdo não selecionado";
            if (!$alternativas) $errors[] = "Alternativas não preenchidas";
            if ($correta === null) $errors[] = "Alternativa correta não selecionada";
            
            $this->setMessage('Dados inválidos: ' . implode(', ', $errors), 'error');
            $this->redirect('/admin/questoes/cadastrar');
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