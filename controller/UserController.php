<?php
abstract class UserController{
    protected UsuarioDao $dao;

    public function __construct()
    {
        $this->dao = new UsuarioDao();
    }

    abstract public function create(): void;
    abstract public function login(string $nome, string $senha): void;
}
?>
