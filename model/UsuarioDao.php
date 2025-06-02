<?php
require_once 'dbConnection.php';
require_once 'Usuario.php';

class UsuarioDao {
    private $conn;

    public function __construct() {
        $this->conn = DbConnection::getConn();
    }

    public function create(Usuario $usuario) {
        $sql = "INSERT INTO usuarios (nome, telefone, email, senha, tipo_usuario, escola) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = DbConnection::getConn()->prepare($sql);
        $stmt->bindValue(1, $usuario->getNome());
        $stmt->bindValue(2, $usuario->getTelefone());
        $stmt->bindValue(3, $usuario->getEmail());
        $stmt->bindValue(4, $usuario->getSenha());
        $stmt->bindValue(5, $usuario->getTipoUsuario());
        $stmt->bindValue(6, $usuario->getEscola());
        $stmt->execute();
    }

    public function searchByEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(Usuario $usuario) {
        $sql = "UPDATE usuarios SET nome = ?, telefone = ?, email = ?, tipo_usuario = ?, escola = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $usuario->getNome());
        $stmt->bindValue(2, $usuario->getTelefone());
        $stmt->bindValue(3, $usuario->getEmail());
        $stmt->bindValue(4, $usuario->getTipoUsuario());
        $stmt->bindValue(5, $usuario->getEscola());
        $stmt->bindValue(6, $usuario->getId());
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}