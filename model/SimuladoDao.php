<?php
require_once 'dbConnection.php';

class SimuladoDao {
    private $pdo;

    public function __construct() {
        $this->pdo = DbConnection::getConn();
    }

    public function create($titulo, $descricao, $status, $questoes) {
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare('INSERT INTO simulados (titulo, descricao, status) VALUES (?, ?, ?)');
            $stmt->execute([$titulo, $descricao, $status]);
            $simuladoId = $this->pdo->lastInsertId();

            $ordem = 1;
            $stmt2 = $this->pdo->prepare('INSERT INTO simulados_questoes (simulado_id, questao_id, ordem) VALUES (?, ?, ?)');
            foreach ($questoes as $idquestao) {
                $stmt2->execute([$simuladoId, $idquestao, $ordem++]);
            }
            $this->pdo->commit();
            return $simuladoId;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function getAll() {
        $sql = 'SELECT * FROM simulados';
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = 'SELECT * FROM simulados WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
