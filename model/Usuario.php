<?php
require_once 'dbConnection.php';

class Usuario {
    private $id, $email, $tipo_usuario, $escola, $telefone, $nome, $senha;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTipoUsuario() {
        return $this->tipo_usuario;
    }

    public function setTipoUsuario($tipo_usuario) {
        $validTipos = ['professor', 'aluno'];
        if (!in_array($tipo_usuario, $validTipos)) {
            throw new InvalidArgumentException("Tipo de usuário inválido.");
        }
        $this->tipo_usuario = $tipo_usuario;
    }

    public function getEscola() {
        return $this->escola;
    }

    public function setEscola($escola) {
        $this->escola = $escola;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }
}