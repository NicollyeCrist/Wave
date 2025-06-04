<?php
session_start();

// Simular usuário professor logado
$_SESSION['usuario'] = [
    'id' => 1,
    'nome' => 'Professor Teste',
    'tipo_usuario' => 'professor'
];

echo "<h2>Teste do Fluxo do Controller</h2>";

try {
    require_once __DIR__ . '/controller/CadastrarConteudo.php';
    
    echo "<p>✓ Controller carregado</p>";
    
    $controller = new CadastrarConteudo();
    echo "<p>✓ Controller instanciado</p>";
    
    // Capturar a saída do método show()
    ob_start();
    $controller->show();
    $output = ob_get_contents();
    ob_end_clean();
    
    echo "<p>✓ Método show() executado</p>";
    
    echo "<h3>Saída do Controller:</h3>";
    echo "<div style='border: 1px solid #ccc; padding: 10px; max-height: 400px; overflow: auto;'>";
    echo $output;
    echo "</div>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erro: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
?>
