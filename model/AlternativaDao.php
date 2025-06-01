<?php
require_once 'dbConnection.php';

class AlternativaDao {
    public function create($id_Questao, $texto, $correta) {
        $sql = 'INSERT INTO alternativas (id_questao, texto, correta) VALUES (?, ?, ?)';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $id_Questao);
        $stmt->bindValue(2, $texto);
        $stmt->bindValue(3, $correta ? 1 : 0, PDO::PARAM_INT); 
        $stmt->execute();
    }

    public function deleteByQuestaoId(int $idQuestao): void {
        $sql = 'DELETE FROM alternativas WHERE id_questao = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$idQuestao]);
    }

    public function readByQuestaoId(int $idQuestao): array {
        $sql = 'SELECT id, texto, correta FROM alternativas WHERE id_questao = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$idQuestao]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as &$row) {
            $row['correta'] = ($row['correta'] == 1); // força booleano
        }
        return $rows;
    }

    public function update(int $id, string $texto, bool $correta): void {
        if ($correta) {
            $sqlQuestao = 'SELECT id_questao FROM alternativas WHERE id = ?';
            $stmtQuestao = DbConnection::getConn()->prepare($sqlQuestao);
            $stmtQuestao->execute([$id]);
            $row = $stmtQuestao->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $idQuestao = $row['id_questao'];
                $sqlZera = 'UPDATE alternativas SET correta = 0 WHERE id_questao = ?';
                $stmtZera = DbConnection::getConn()->prepare($sqlZera);
                $stmtZera->execute([$idQuestao]);
            }
        }
        $sql = 'UPDATE alternativas SET texto = ?, correta = ? WHERE id = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$texto, $correta ? 1 : 0, $id]);
    }
}
?>
