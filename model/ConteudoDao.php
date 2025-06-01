<?php

require_once 'dbConnection.php'; 
require_once 'Conteudo.php';

class ConteudoDao {
    
    public function create(Conteudo $conteudo) {
        $sql = 'INSERT INTO conteudos (titulo, descricao, linkconteudo) VALUES (?,?,?)';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $conteudo->getTitulo());
        $stmt->bindValue(2, $conteudo->getDescricao());
        $stmt->bindValue(3, $conteudo->getLinkConteudo());
        $stmt->execute();
    }

    public function readAll(): array
    {
        $sql = 'SELECT * FROM conteudos';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lista = [];
        foreach ($result as $row) {
            $c = new Conteudo();
            $c->setId($row['id']); // Correção: Alterado de setIdConteudo para setId
            $c->setTitulo($row['titulo']);
            $c->setDescricao($row['descricao']);
            $c->setLinkConteudo($row['linkconteudo']);
            $lista[] = $c;
        }

        return $lista;
    }

}

?>