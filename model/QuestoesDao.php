<?php

require_once 'dbConnection.php';
require_once __DIR__ . '/Questoes.php';

class QuestoesDao
{
    public function create(Questoes $questao)
    {
        $sql = 'INSERT INTO questao (enunciado, idconteudo) VALUES (?, ?)';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $questao->getEnunciado());
        $stmt->bindValue(2, $questao->getIdConteudo());
        $stmt->execute();
    }
    public function readAll(): array
    {
        $sql = 'SELECT idquestao, enunciado, idconteudo FROM questao';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $q = new Questoes();
            $q->setIdQuestao($row['idquestao']);
            $q->setEnunciado($row['enunciado']);
            $q->setIdConteudo($row['idconteudo']);
            $result[] = $q;
        }
        return $result;
    }

    public function readById(int $id): ?Questoes
    {
        $sql = 'SELECT idquestao, enunciado, idconteudo FROM questao WHERE idquestao = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $q = new Questoes();
        $q->setIdQuestao($row['idquestao']);
        $q->setEnunciado($row['enunciado']);
        $q->setIdConteudo($row['idconteudo']);
        return $q;
    }

    public function update(Questoes $questao): void
    {
        $sql = 'UPDATE questao SET enunciado = ?, idconteudo = ? WHERE idquestao = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([
            $questao->getEnunciado(),
            $questao->getIdConteudo(),
            $questao->getIdQuestao()
        ]);
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM questao WHERE idquestao = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$id]);
    }
}

?>