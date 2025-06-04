<?php

class Admin {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $telefone;
    private $cargo;
    private $ativo;
    private $ultimoLogin;
    private $createdAt;
    private $updatedAt;

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha): void {
        // Hash da senha automaticamente
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function setSenhaHash($senhaHash): void {
        // Para quando já temos o hash (ex: ao buscar do banco)
        $this->senha = $senhaHash;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone): void {
        $this->telefone = $telefone;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function setCargo($cargo): void {
        $this->cargo = $cargo;
    }

    public function isAtivo() {
        return $this->ativo;
    }

    public function setAtivo($ativo): void {
        $this->ativo = $ativo;
    }

    public function getUltimoLogin() {
        return $this->ultimoLogin;
    }

    public function setUltimoLogin($ultimoLogin): void {
        $this->ultimoLogin = $ultimoLogin;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt): void {
        $this->updatedAt = $updatedAt;
    }

    // Método para verificar senha
    public function verificarSenha($senhaDigitada): bool {
        return password_verify($senhaDigitada, $this->senha);
    }
}
?>
