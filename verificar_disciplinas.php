<?php
echo "<h2>Teste Direto SQL - Disciplinas</h2>";

try {
    require_once __DIR__ . '/model/dbConnection.php';
    
    $conn = DbConnection::getConn();
    
    // Verificar quantas disciplinas existem
    $countStmt = $conn->query("SELECT COUNT(*) as total FROM disciplinas");
    $count = $countStmt->fetch(PDO::FETCH_ASSOC);
    echo "<p><strong>Total de disciplinas no banco:</strong> " . $count['total'] . "</p>";
    
    if ($count['total'] == 0) {
        echo "<p style='color: orange;'>⚠️ Nenhuma disciplina encontrada. Vamos inserir as disciplinas padrão...</p>";
        
        // Inserir disciplinas padrão se não existem
        $disciplinas = [
            ['nome' => 'Geometria Plana', 'descricao' => 'Estudo de figuras geométricas em duas dimensões'],
            ['nome' => 'Estatística', 'descricao' => 'Coleta, organização e interpretação de dados'],
            ['nome' => 'Função Afim', 'descricao' => 'Funções de primeiro grau e suas aplicações'],
            ['nome' => 'Função Quadrática', 'descricao' => 'Funções de segundo grau e suas propriedades'],
            ['nome' => 'Função Exponencial', 'descricao' => 'Funções exponenciais e crescimento']
        ];
        
        $insertStmt = $conn->prepare("INSERT IGNORE INTO disciplinas (nome, descricao) VALUES (?, ?)");
        
        foreach ($disciplinas as $disciplina) {
            $insertStmt->execute([$disciplina['nome'], $disciplina['descricao']]);
        }
        
        echo "<p>✓ Disciplinas inseridas!</p>";
        
        // Verificar novamente
        $countStmt = $conn->query("SELECT COUNT(*) as total FROM disciplinas");
        $newCount = $countStmt->fetch(PDO::FETCH_ASSOC);
        echo "<p><strong>Novo total:</strong> " . $newCount['total'] . "</p>";
    }
    
    // Listar todas as disciplinas
    $stmt = $conn->query("SELECT * FROM disciplinas ORDER BY nome");
    $disciplinas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($disciplinas) > 0) {
        echo "<h3>Disciplinas Cadastradas:</h3>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background: #f0f0f0;'><th>ID</th><th>Nome</th><th>Descrição</th></tr>";
        foreach ($disciplinas as $disciplina) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($disciplina['id']) . "</td>";
            echo "<td>" . htmlspecialchars($disciplina['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($disciplina['descricao'] ?? '') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erro: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
?>
