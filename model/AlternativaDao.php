<?php
require_once 'dbConnection.php';

class AlternativaDao {
    public function create($idQuestao, $texto, $correta) {
        $sql = 'INSERT INTO alternativas (idquestao, texto, correta) VALUES (?, ?, ?)';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $idQuestao);
        $stmt->bindValue(2, $texto);
        $stmt->bindValue(3, $correta ? 1 : 0, PDO::PARAM_INT); 
        $stmt->execute();
    }
}
?>
