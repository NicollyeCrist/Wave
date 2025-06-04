<?php

require_once 'dbConnection.php';
require_once 'Admin.php';

class AdminDao {
    
    public function create(Admin $admin): int {
        $sql = 'INSERT INTO admins (nome, email, senha, telefone, cargo, ativo) VALUES (?, ?, ?, ?, ?, ?)';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $admin->getNome());
        $stmt->bindValue(2, $admin->getEmail());
        $stmt->bindValue(3, $admin->getSenha()); 
        $stmt->bindValue(4, $admin->getTelefone());
        $stmt->bindValue(5, $admin->getCargo());
        $stmt->bindValue(6, $admin->isAtivo());
        $stmt->execute();
        
        return DbConnection::getConn()->lastInsertId();
    }

    public function readAll(): array {
        $sql = 'SELECT * FROM admins WHERE ativo = 1 ORDER BY nome';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lista = [];
        foreach ($result as $row) {
            $admin = $this->createAdminFromArray($row);
            $lista[] = $admin;
        }

        return $lista;
    }

    public function findById($id): ?Admin {
        $sql = 'SELECT * FROM admins WHERE id = ? AND ativo = 1';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row ? $this->createAdminFromArray($row) : null;
    }

    public function findByEmail($email): ?Admin {
        $sql = 'SELECT * FROM admins WHERE email = ? AND ativo = 1';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row ? $this->createAdminFromArray($row) : null;
    }

    public function updateUltimoLogin($id): bool {
        $sql = 'UPDATE admins SET ultimo_login = CURRENT_TIMESTAMP WHERE id = ?';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        
        return $stmt->execute();
    }

    public function update(Admin $admin): bool {
        $sql = 'UPDATE admins SET nome = ?, email = ?, telefone = ?, cargo = ?, ativo = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $admin->getNome());
        $stmt->bindValue(2, $admin->getEmail());
        $stmt->bindValue(3, $admin->getTelefone());
        $stmt->bindValue(4, $admin->getCargo());
        $stmt->bindValue(5, $admin->isAtivo());
        $stmt->bindValue(6, $admin->getId());
        
        return $stmt->execute();
    }

    public function updateSenha($id, $novaSenha): bool {
        $sql = 'UPDATE admins SET senha = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, password_hash($novaSenha, PASSWORD_DEFAULT));
        $stmt->bindValue(2, $id);
        
        return $stmt->execute();
    }

    public function delete($id): bool {
        $sql = 'DELETE FROM admins WHERE id = ?';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        
        return $stmt->execute();
    }

    public function desativar($id): bool {
        $sql = 'UPDATE admins SET ativo = 0, updated_at = CURRENT_TIMESTAMP WHERE id = ?';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        
        return $stmt->execute();
    }

    public function emailExists($email, $excludeId = null): bool {
        $sql = 'SELECT COUNT(*) FROM admins WHERE email = ?';
        if ($excludeId) {
            $sql .= ' AND id != ?';
        }

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $email);
        if ($excludeId) {
            $stmt->bindValue(2, $excludeId);
        }
        $stmt->execute();
        
        return $stmt->fetchColumn() > 0;
    }

    private function createAdminFromArray($row): Admin {
        $admin = new Admin();
        $admin->setId($row['id']);
        $admin->setNome($row['nome']);
        $admin->setEmail($row['email']);
        $admin->setSenhaHash($row['senha']); // Usar setSenhaHash para não rehashear
        $admin->setTelefone($row['telefone']);
        $admin->setCargo($row['cargo']);
        $admin->setAtivo($row['ativo']);
        $admin->setUltimoLogin($row['ultimo_login']);
        $admin->setCreatedAt($row['created_at']);
        $admin->setUpdatedAt($row['updated_at']);
        
        return $admin;
    }
}
?>
