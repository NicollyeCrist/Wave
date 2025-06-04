<?php
// Teste simples e direto de conexão e disciplinas

echo "<h2>Teste Simples - Disciplinas</h2>";

try {
    // Teste direto da conexão
    require_once __DIR__ . '/model/dbConnection.php';
    
    $conn = DbConnection::getConn();
    echo "<p>✓ Conexão estabelecida com sucesso</p>";
    
    // Teste direto da query
    $sql = "SELECT * FROM disciplinas";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $disciplinas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<p>✓ Query executada. Resultados encontrados: " . count($disciplinas) . "</p>";
    
    if (count($disciplinas) > 0) {
        echo "<h3>Disciplinas na base de dados:</h3>";
        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
        echo "<tr><th>ID</th><th>Nome</th></tr>";
        foreach ($disciplinas as $disciplina) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($disciplina['id']) . "</td>";
            echo "<td>" . htmlspecialchars($disciplina['nome']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: red;'>⚠️ Nenhuma disciplina encontrada na tabela!</p>";
        
        // Vamos verificar se a tabela existe
        $tables = $conn->query("SHOW TABLES LIKE 'disciplinas'")->fetchAll();
        if (empty($tables)) {
            echo "<p style='color: red;'>❌ A tabela 'disciplinas' não existe!</p>";
        } else {
            echo "<p>✓ A tabela 'disciplinas' existe</p>";
            
            // Verificar estrutura da tabela
            $structure = $conn->query("DESCRIBE disciplinas")->fetchAll(PDO::FETCH_ASSOC);
            echo "<h4>Estrutura da tabela:</h4>";
            echo "<table border='1' style='border-collapse: collapse;'>";
            echo "<tr><th>Campo</th><th>Tipo</th><th>Null</th><th>Key</th></tr>";
            foreach ($structure as $column) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($column['Field']) . "</td>";
                echo "<td>" . htmlspecialchars($column['Type']) . "</td>";
                echo "<td>" . htmlspecialchars($column['Null']) . "</td>";
                echo "<td>" . htmlspecialchars($column['Key']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erro: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

echo "<hr>";

// Teste através do DisciplinaDao
echo "<h3>Teste através do DisciplinaDao:</h3>";
try {
    require_once __DIR__ . '/model/DisciplinaDao.php';
    
    $dao = new DisciplinaDao();
    $disciplinas = $dao->readAll();
    
    echo "<p>✓ DisciplinaDao criado e método readAll() executado</p>";
    echo "<p>Resultados: " . count($disciplinas) . " disciplinas</p>";
    
    if (count($disciplinas) > 0) {
        echo "<ul>";
        foreach ($disciplinas as $disciplina) {
            echo "<li>ID: " . htmlspecialchars($disciplina['id']) . " - Nome: " . htmlspecialchars($disciplina['nome']) . "</li>";
        }
        echo "</ul>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erro no DisciplinaDao: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
