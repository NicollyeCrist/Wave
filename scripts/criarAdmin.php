<?php
require_once __DIR__ . '/../model/dbConnection.php';
require_once __DIR__ . '/../model/Admin.php';
require_once __DIR__ . '/../model/AdminDao.php';

echo "=== Verificação do Sistema Admin ===\n\n";

try {
    $sql = "SHOW TABLES LIKE 'admins'";
    $stmt = DbConnection::getConn()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    
    if (!$result) {
        echo "❌ Tabela 'admins' não existe. Criando tabela...\n";
        
        $createTable = "
        CREATE TABLE admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL,
            telefone VARCHAR(20),
            cargo VARCHAR(100) DEFAULT 'Administrador',
            ativo BOOLEAN DEFAULT TRUE,
        )";
        
        $stmt = DbConnection::getConn()->prepare($createTable);
        $stmt->execute();
        echo "✅ Tabela 'admins' criada com sucesso!\n";
    } else {
        echo "✅ Tabela 'admins' existe.\n";
    }
    
    $adminDao = new AdminDao();
    $admins = $adminDao->readAll();
    
    if (empty($admins)) {
        echo "❌ Nenhum admin cadastrado. Criando admin padrão...\n";
        
        $admin = new Admin();
        $admin->setNome('Administrador');
        $admin->setEmail('admin@mesominds.com');
        $admin->setSenha('admin123'); 
        $admin->setTelefone('11999999999');
        $admin->setCargo('Super Administrador');
        $admin->setAtivo(true);
        
        $id = $adminDao->create($admin);
        
        if ($id) {
            echo "✅ Admin padrão criado com sucesso!\n";
            echo "   Email: admin@mesominds.com\n";
            echo "   Senha: admin123\n";
        } else {
            echo "❌ Erro ao criar admin padrão.\n";
        }
    } else {
        echo "✅ Existem " . count($admins) . " admin(s) cadastrado(s):\n";
        foreach ($admins as $admin) {
            echo "   - {$admin->getNome()} ({$admin->getEmail()}) - {$admin->getCargo()}\n";
        }
    }
    
    echo "\n=== Estrutura da Tabela Admins ===\n";
    $sql = "DESCRIBE admins";
    $stmt = DbConnection::getConn()->prepare($sql);
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($columns as $column) {
        echo "- {$column['Field']}: {$column['Type']}\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}

echo "\n=== Verificação Concluída ===\n";
?>
