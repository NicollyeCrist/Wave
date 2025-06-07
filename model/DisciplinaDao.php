<?php

require_once 'dbConnection.php'; 
require_once 'Disciplina.php';

class DisciplinaDao {
    
    public function readAll(): array
    {
        $sql = 'SELECT * FROM disciplinas';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id): ?array
    {
        $sql = 'SELECT * FROM disciplinas WHERE id = ?';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function findByNome($nome): ?array
    {
        $sql = 'SELECT * FROM disciplinas WHERE nome = ?';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $nome);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
    
    public function countAll(): int
    {
        $sql = 'SELECT COUNT(*) FROM disciplinas';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute();
        
        return (int) $stmt->fetchColumn();
    }
}

?>
