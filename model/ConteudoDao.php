<?php

require_once 'dbConnection.php'; 
require_once 'Conteudo.php';

class ConteudoDao {
    
    public function create(Conteudo $conteudo) {
        $sql = 'INSERT INTO conteudos (titulo, descricao, id_disciplina, links) VALUES (?,?,?,?)';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $conteudo->getTitulo());
        $stmt->bindValue(2, $conteudo->getDescricao());
        $stmt->bindValue(3, $conteudo->getIdDisciplina());
        $stmt->bindValue(4, $conteudo->getLinks());
        $stmt->execute();
        
        return DbConnection::getConn()->lastInsertId();
    }    public function readAll(): array
    {
        $sql = 'SELECT c.*, d.nome as disciplina_nome 
                FROM conteudos c 
                LEFT JOIN disciplinas d ON c.id_disciplina = d.id 
                ORDER BY c.created_at DESC';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lista = [];
        foreach ($result as $row) {
            $c = new Conteudo();
            $c->setId($row['id']);
            $c->setTitulo($row['titulo']);
            $c->setDescricao($row['descricao']);
            $c->setIdDisciplina($row['id_disciplina']);
            $c->setLinks($row['links']);
            $c->setCreatedAt($row['created_at']);
            
            $c->disciplinaNome = $row['disciplina_nome'];
            
            $lista[] = $c;
        }

        return $lista;
    }    public function findById($id): ?Conteudo
    {
        $sql = 'SELECT c.*, d.nome as disciplina_nome 
                FROM conteudos c 
                LEFT JOIN disciplinas d ON c.id_disciplina = d.id 
                WHERE c.id = ?';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {
            return null;
        }

        $c = new Conteudo();
        $c->setId($row['id']);
        $c->setTitulo($row['titulo']);
        $c->setDescricao($row['descricao']);
        $c->setIdDisciplina($row['id_disciplina']);
        $c->setLinks($row['links']);
        $c->setCreatedAt($row['created_at']);
        $c->disciplinaNome = $row['disciplina_nome'];

        return $c;
    }

    public function findByDisciplina($idDisciplina): array
    {
        $sql = 'SELECT c.*, d.nome as disciplina_nome 
                FROM conteudos c 
                LEFT JOIN disciplinas d ON c.id_disciplina = d.id 
                WHERE c.id_disciplina = ? 
                ORDER BY c.created_at DESC';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $idDisciplina);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);        $lista = [];
        foreach ($result as $row) {
            $c = new Conteudo();
            $c->setId($row['id']);
            $c->setTitulo($row['titulo']);
            $c->setDescricao($row['descricao']);
            $c->setIdDisciplina($row['id_disciplina']);
            $c->setLinks($row['links']);
            $c->setCreatedAt($row['created_at']);
            $c->disciplinaNome = $row['disciplina_nome'];
            
            $lista[] = $c;
        }

        return $lista;
    }

    public function update(Conteudo $conteudo) {
        $sql = 'UPDATE conteudos SET titulo = ?, descricao = ?, id_disciplina = ?, links = ? WHERE id = ?';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $conteudo->getTitulo());
        $stmt->bindValue(2, $conteudo->getDescricao());
        $stmt->bindValue(3, $conteudo->getIdDisciplina());
        $stmt->bindValue(4, $conteudo->getLinks());
        $stmt->bindValue(5, $conteudo->getId());
        
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = 'DELETE FROM conteudos WHERE id = ?';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        
        return $stmt->execute();
    }
      public function countAll(): int
    {
        $sql = 'SELECT COUNT(*) FROM conteudos';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute();
        
        return (int) $stmt->fetchColumn();
    }

    public function findByTitulo(string $titulo): array
    {
        $sql = 'SELECT c.*, d.nome as disciplina_nome 
                FROM conteudos c 
                LEFT JOIN disciplinas d ON c.id_disciplina = d.id 
                WHERE c.titulo LIKE ? 
                ORDER BY c.created_at DESC';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, "%$titulo%");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lista = [];
        
        foreach ($result as $row) {
            $c = new Conteudo();
            $c->setId($row['id']);
            $c->setTitulo($row['titulo']);
            $c->setDescricao($row['descricao']);
            $c->setIdDisciplina($row['id_disciplina']);
            $c->setLinks($row['links']);
            $c->setCreatedAt($row['created_at']);
            $c->disciplinaNome = $row['disciplina_nome'];
            
            $lista[] = $c;
        }

        return $lista;
    }
}

?>