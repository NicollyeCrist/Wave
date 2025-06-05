<?php

class Questoes{
    private $id, $enunciado, $id_conteudo, $id_questao, $nivel_dificuldade, $correcao, $created_at;
    private $alternativas; 
    public $conteudoTitulo; 

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEnunciado() {
        return $this->enunciado;
    }

    public function setEnunciado($enunciado) {
        $this->enunciado = $enunciado;
    }

    public function getIdConteudo() {
        return $this->id_conteudo;
    }

    public function setIdConteudo($id_conteudo) {
        $this->id_conteudo = $id_conteudo;
    }
    
    public function getIdQuestao() {
        return $this->id_questao;
    }

    public function getNivelDificuldade() {
        return $this->nivel_dificuldade;
    }

    public function setNivelDificuldade($nivel_dificuldade) {
        $this->nivel_dificuldade = $nivel_dificuldade;
    }

    public function getCorrecao() {
        return $this->correcao;
    }

    public function setCorrecao($correcao) {
        $this->correcao = $correcao;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function getAlternativas() {
        return $this->alternativas;
    }

    public function setAlternativas($alternativas) {
        $this->alternativas = $alternativas;
    }
}

?>