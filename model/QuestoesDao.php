<?php

require_once 'dbConnection.php'; 

class QuestoesDao
{
    public function create(Questoes $questao) {
        $sql = 'INSERT INTO questao (enunciado, idconteudo) VALUES (?, ?)';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $questao->getEnunciado());
        $stmt->bindValue(2, $questao->getIdConteudo());
        $stmt->execute();
    }
    
}

?>