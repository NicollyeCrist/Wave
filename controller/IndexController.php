<?php
require_once __DIR__ . '/../model/ConteudoDao.php';

class IndexController
{
    private ConteudoDao $conteudoDao;

    public function __construct()
    {
        $this->conteudoDao = new ConteudoDao();
    }

    public function index(): void
    {
        $conteudos = $this->conteudoDao->readAll();
        
        $assuntos = $this->agruparConteudosPorAssunto($conteudos);
        
        $this->render('indexDinamico', [
            'conteudos' => $conteudos,
            'assuntos' => $assuntos
        ]);
    }

    private function agruparConteudosPorAssunto(array $conteudos): array
    {
        $assuntos = [];
        
        foreach ($conteudos as $conteudo) {
            // Extrair primeira palavra do título como assunto principal
            $palavras = explode(' ', $conteudo->getTitulo());
            $assuntoPrincipal = $palavras[0];
            
            if (!isset($assuntos[$assuntoPrincipal])) {
                $assuntos[$assuntoPrincipal] = [
                    'nome' => $assuntoPrincipal,
                    'conteudos' => [],
                    'total_questoes' => 0
                ];
            }
            
            $assuntos[$assuntoPrincipal]['conteudos'][] = $conteudo;
        }
        
        return $assuntos;
    }

    private function render(string $view, array $data = []): void
    {
        // Extrair variáveis para o escopo da view
        extract($data);
        
        // Incluir a view
        $viewPath = __DIR__ . "/../view/$view.php";
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            throw new Exception("View não encontrada: $view");
        }
    }
}
?>
