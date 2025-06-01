<?php

require_once 'dbConnection.php';
require_once __DIR__ . '/Questoes.php';

class QuestoesDao
{
    public function create(Questoes $questao)
    {
        $sql = 'INSERT INTO questoes (enunciado, id_conteudo) VALUES (?, ?)';

        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $questao->getEnunciado());
        $stmt->bindValue(2, $questao->getIdConteudo());
        $stmt->execute();
    }
    public function readAll(): array
    {
        $sql = 'SELECT id, enunciado, id_conteudo FROM questoes';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $q = new Questoes();
            $q->setId($row['id']);
            $q->setEnunciado($row['enunciado']);
            $q->setIdConteudo($row['id_conteudo']);
            $result[] = $q;
        }
        return $result;
    }

    public function readById(int $id): ?Questoes
    {
        $sql = 'SELECT id, enunciado, id_conteudo FROM questoes WHERE id = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $q = new Questoes();
        $q->setId($row['id']);
        $q->setEnunciado($row['enunciado']);
        $q->setIdConteudo($row['id_conteudo']);
        return $q;
    }

    public function update(Questoes $questao): void
    {
        $sql = 'UPDATE questoes SET enunciado = ?, id_conteudo = ? WHERE id = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([
            $questao->getEnunciado(),
            $questao->getIdConteudo(),
            $questao->getId()
        ]);
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM questoes WHERE id = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$id]);
    }
}

?>