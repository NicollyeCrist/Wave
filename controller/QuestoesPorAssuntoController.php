<?php

require_once __DIR__ . '/../model/QuestoesDao.php';
require_once __DIR__ . '/../model/ConteudoDao.php';
require_once __DIR__ . '/../model/AlternativaDao.php';

class QuestoesPorAssuntoController
{
    private QuestoesDao $questoesDao;
    private ConteudoDao $conteudoDao;
    private AlternativaDao $alternativaDao;

    public function __construct()
    {
        $this->questoesDao = new QuestoesDao();
        $this->conteudoDao = new ConteudoDao();
        $this->alternativaDao = new AlternativaDao();
    }

    public function index(): void
    {
        $conteudos = $this->conteudoDao->readAll();

        $assuntos = $this->agruparConteudosPorAssunto($conteudos);

        $this->render('questoesPorAssunto', [
            'conteudos' => $conteudos,
            'assuntos' => $assuntos
        ]);
    }
    public function porAssunto(): void
    {
        $assunto = $_GET['assunto'] ?? $_POST['assunto'] ?? '';
        $nivel = $_GET['nivel'] ?? $_POST['nivel'] ?? '';

        $todosConteudos = $this->conteudoDao->readAll();
        $assuntos = $this->agruparConteudosPorAssunto($todosConteudos);

        if (empty($assunto)) {
            $this->render('questoesPorAssunto', [
                'conteudos' => [],
                'questoes' => [],
                'questoesAgrupadas' => [],
                'assuntos' => $assuntos,
                'assuntoAtual' => '',
                'nivelAtual' => ''
            ]);
            return;
        }

        $conteudos = $this->conteudoDao->findByTitulo($assunto);

        if (empty($conteudos)) {
            $conteudos = $this->buscarConteudosPorPalavraChave($assunto, $todosConteudos);
        }

        if (empty($conteudos)) {
            $questoes = [];
            $questoesAgrupadas = [];
        } else {
            $idsConteudo = array_map(fn($c) => $c->getId(), $conteudos);

            if (!empty($nivel)) {
                $questoes = [];
                foreach ($idsConteudo as $idConteudo) {
                    $questoesNivel = $this->questoesDao->findByConteudoAndNivel($idConteudo, $nivel);
                    $questoes = array_merge($questoes, $questoesNivel);
                }
            } else {
                $questoes = $this->questoesDao->findByConteudos($idsConteudo);
            }

            $questoesAgrupadas = $this->agruparQuestoesPorNivel($questoes);

            foreach ($questoes as $questao) {
                $questao->setAlternativas($this->alternativaDao->findByQuestao($questao->getId()));
            }
        }

        $this->render('questoesPorAssunto', [
            'assuntoAtual' => $assunto,
            'nivelAtual' => $nivel,
            'conteudos' => $conteudos,
            'questoes' => $questoes,
            'questoesAgrupadas' => $questoesAgrupadas,
            'assuntos' => $assuntos
        ]);
    }

    private function agruparConteudosPorAssunto(array $conteudos): array
    {
        $assuntos = [];

        foreach ($conteudos as $conteudo) {
            $palavras = explode(' ', $conteudo->getTitulo());
            $assuntoPrincipal = $palavras[0];

            if (!isset($assuntos[$assuntoPrincipal])) {
                $assuntos[$assuntoPrincipal] = [];
            }

            $assuntos[$assuntoPrincipal][] = $conteudo;
        }

        return $assuntos;
    }

    private function agruparQuestoesPorNivel(array $questoes): array
    {
        $agrupadas = [
            '1' => [],
            '2' => [],
            '3' => []
        ];

        foreach ($questoes as $questao) {
            $nivel = $questao->getNivelDificuldade();
            if (isset($agrupadas[$nivel])) {
                $agrupadas[$nivel][] = $questao;
            }
        }
        return $agrupadas;
    }

    private function buscarConteudosPorPalavraChave(string $assunto, array $todosConteudos): array
    {
        $conteudosEncontrados = [];
        $assuntoLower = strtolower($assunto);

        foreach ($todosConteudos as $conteudo) {
            $tituloLower = strtolower($conteudo->getTitulo());
            $descricaoLower = strtolower($conteudo->getDescricao());

            if (
                strpos($tituloLower, $assuntoLower) !== false ||
                strpos($descricaoLower, $assuntoLower) !== false
            ) {
                $conteudosEncontrados[] = $conteudo;
            }
        }

        return $conteudosEncontrados;
    }

    private function render(string $view, array $data = []): void
    {
        extract($data);

        $viewPath = __DIR__ . "/../view/$view.php";
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            throw new Exception("View não encontrada: $view");
        }
    }
}

?>