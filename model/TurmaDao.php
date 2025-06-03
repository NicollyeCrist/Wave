<?php

require_once 'dbConnection.php';
require_once __DIR__ . '/Turma.php';

class TurmaDao
{
    public function create(Turma $turma)
    {
        $sql = 'INSERT INTO turmas (nome, descricao) VALUES (?, ?)';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $turma->getNome());
        $stmt->bindValue(2, $turma->getDescricao());
        $stmt->execute();
        
        return DbConnection::getConn()->lastInsertId();
    }

    public function readAll(): array
    {
        $sql = 'SELECT id, nome, descricao, created_at FROM turmas ORDER BY created_at DESC';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $result = [];
        foreach ($rows as $row) {
            $turma = new Turma();
            $turma->setId($row['id']);
            $turma->setNome($row['nome']);
            $turma->setDescricao($row['descricao']);
            $turma->setCreatedAt($row['created_at']);
            $result[] = $turma;
        }
        return $result;
    }

    public function readById(int $id): ?Turma
    {
        $sql = 'SELECT id, nome, descricao, created_at FROM turmas WHERE id = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {
            return null;
        }
        
        $turma = new Turma();
        $turma->setId($row['id']);
        $turma->setNome($row['nome']);
        $turma->setDescricao($row['descricao']);
        $turma->setCreatedAt($row['created_at']);
        return $turma;
    }

    public function update(Turma $turma): void
    {
        $sql = 'UPDATE turmas SET nome = ?, descricao = ? WHERE id = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([
            $turma->getNome(),
            $turma->getDescricao(),
            $turma->getId()
        ]);
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM turma_usuario WHERE id_turma = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$id]);
        
        $sql = 'DELETE FROM turmas WHERE id = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$id]);
    }

    public function addUsuarioToTurma(int $idTurma, int $idUsuario): bool
    {
        $sql = 'SELECT COUNT(*) FROM turma_usuario WHERE id_turma = ? AND id_usuario = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$idTurma, $idUsuario]);
        
        if ($stmt->fetchColumn() > 0) {
            return false; 
        }
        
        $sql = 'INSERT INTO turma_usuario (id_turma, id_usuario) VALUES (?, ?)';
        $stmt = DbConnection::getConn()->prepare($sql);
        return $stmt->execute([$idTurma, $idUsuario]);
    }

    public function removeUsuarioFromTurma(int $idTurma, int $idUsuario): bool
    {
        $sql = 'DELETE FROM turma_usuario WHERE id_turma = ? AND id_usuario = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        return $stmt->execute([$idTurma, $idUsuario]);
    }

    public function getTurmasByUsuario(int $idUsuario): array
    {
        $sql = 'SELECT t.id, t.nome, t.descricao, t.created_at 
                FROM turmas t 
                INNER JOIN turma_usuario tu ON t.id = tu.id_turma 
                WHERE tu.id_usuario = ? 
                ORDER BY t.created_at DESC';
        
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$idUsuario]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $result = [];
        foreach ($rows as $row) {
            $turma = new Turma();
            $turma->setId($row['id']);
            $turma->setNome($row['nome']);
            $turma->setDescricao($row['descricao']);
            $turma->setCreatedAt($row['created_at']);
            $result[] = $turma;
        }
        return $result;
    }

    public function getUsuariosByTurma(int $idTurma): array
    {
        $sql = 'SELECT u.id, u.nome, u.email, u.tipo_usuario 
                FROM usuarios u 
                INNER JOIN turma_usuario tu ON u.id = tu.id_usuario 
                WHERE tu.id_turma = ? 
                ORDER BY u.nome';
        
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$idTurma]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
