<?php

require_once 'dbConnection.php'; 
require_once 'Conteudo.php';

class ConteudoDao {
    
    public function create(Conteudo $conteudo) {
        $sql = 'INSERT INTO conteudo (tituloConteudo, descricao, linkconteudo) VALUES (?,?,?)';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $conteudo->getTitulo());
        $stmt->bindValue(2, $conteudo->getDecricao());
        $stmt->bindValue(3, $conteudo->getLinkConteudo());
        $stmt->execute();
    }

    public function readAll(): array
    {
        $sql = 'SELECT * FROM conteudo';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lista = [];
        foreach ($result as $row) {
            $c = new Conteudo();
            $c->setIdConteudo($row['idconteudo']);
            $c->setTitulo($row['tituloConteudo']);
            $c->setDecricao($row['descricao']);
            $c->setLinkConteudo($row['linkConteudo']);
            $lista[] = $c;
        }

        return $lista;
    }

}

?>