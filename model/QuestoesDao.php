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
    }    public function readAll(): array
    {
        $sql = 'SELECT id, enunciado, id_conteudo, nivel_dificuldade, correcao, created_at FROM questoes';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $q = new Questoes();
            $q->setId($row['id']);
            $q->setEnunciado($row['enunciado']);
            $q->setIdConteudo($row['id_conteudo']);
            $q->setNivelDificuldade($row['nivel_dificuldade']);
            $q->setCorrecao($row['correcao']);
            $q->setCreatedAt($row['created_at']);
            $result[] = $q;
        }
        return $result;
    }    public function readById(int $id): ?Questoes
    {
        $sql = 'SELECT id, enunciado, id_conteudo, nivel_dificuldade, correcao, created_at FROM questoes WHERE id = ?';
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
        $q->setNivelDificuldade($row['nivel_dificuldade']);
        $q->setCorrecao($row['correcao']);
        $q->setCreatedAt($row['created_at']);
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
    }    public function delete(int $id): void
    {
        $sql = 'DELETE FROM questoes WHERE id = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$id]);
    }    public function findByConteudo(int $idConteudo): array
    {
        $sql = 'SELECT id, enunciado, id_conteudo, nivel_dificuldade, correcao, created_at FROM questoes WHERE id_conteudo = ? ORDER BY nivel_dificuldade, id';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$idConteudo]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $result = [];
        foreach ($rows as $row) {
            $q = new Questoes();
            $q->setId($row['id']);
            $q->setEnunciado($row['enunciado']);
            $q->setIdConteudo($row['id_conteudo']);
            $q->setNivelDificuldade($row['nivel_dificuldade']);
            $q->setCorrecao($row['correcao']);
            $q->setCreatedAt($row['created_at']);
            $result[] = $q;
        }
        return $result;
    }

    public function countByConteudo(int $idConteudo): int
    {
        $sql = 'SELECT COUNT(*) as total FROM questoes WHERE id_conteudo = ?';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$idConteudo]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function findByConteudoAndNivel(int $idConteudo, string $nivel): array
    {
        $sql = 'SELECT id, enunciado, id_conteudo, nivel_dificuldade, correcao, created_at 
                FROM questoes 
                WHERE id_conteudo = ? AND nivel_dificuldade = ? 
                ORDER BY id';
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute([$idConteudo, $nivel]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $result = [];
        foreach ($rows as $row) {
            $q = new Questoes();
            $q->setId($row['id']);
            $q->setEnunciado($row['enunciado']);
            $q->setIdConteudo($row['id_conteudo']);
            $q->setNivelDificuldade($row['nivel_dificuldade']);
            $q->setCorrecao($row['correcao']);
            $q->setCreatedAt($row['created_at']);
            $result[] = $q;
        }
        return $result;
    }

    public function findByConteudos(array $idsConteudo): array
    {
        if (empty($idsConteudo)) {
            return [];
        }
        
        $placeholders = str_repeat('?,', count($idsConteudo) - 1) . '?';
        $sql = "SELECT q.id, q.enunciado, q.id_conteudo, q.nivel_dificuldade, q.correcao, q.created_at,
                       c.titulo as conteudo_titulo
                FROM questoes q 
                LEFT JOIN conteudos c ON q.id_conteudo = c.id
                WHERE q.id_conteudo IN ($placeholders) 
                ORDER BY q.nivel_dificuldade, q.id";
        
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute($idsConteudo);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $result = [];
        foreach ($rows as $row) {
            $q = new Questoes();
            $q->setId($row['id']);
            $q->setEnunciado($row['enunciado']);
            $q->setIdConteudo($row['id_conteudo']);
            $q->setNivelDificuldade($row['nivel_dificuldade']);
            $q->setCorrecao($row['correcao']);
            $q->setCreatedAt($row['created_at']);
            $q->conteudoTitulo = $row['conteudo_titulo']; // Propriedade adicional
            $result[] = $q;
        }
        return $result;
    }

    public function getQuestoesPorAssunto(string $assunto): array
    {
        $sql = "SELECT q.id, q.enunciado, q.id_conteudo, q.nivel_dificuldade, q.correcao, q.created_at,
                       c.titulo as conteudo_titulo
                FROM questoes q 
                LEFT JOIN conteudos c ON q.id_conteudo = c.id
                WHERE c.titulo LIKE ? 
                ORDER BY q.nivel_dificuldade, q.id";
        
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->execute(["%$assunto%"]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $result = [];
        foreach ($rows as $row) {
            $q = new Questoes();
            $q->setId($row['id']);
            $q->setEnunciado($row['enunciado']);
            $q->setIdConteudo($row['id_conteudo']);
            $q->setNivelDificuldade($row['nivel_dificuldade']);
            $q->setCorrecao($row['correcao']);
            $q->setCreatedAt($row['created_at']);
            $q->conteudoTitulo = $row['conteudo_titulo'];
            $result[] = $q;
        }
        return $result;
    }
}

?>