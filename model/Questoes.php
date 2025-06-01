<?php

class Questoes{
    private $id, $enunciado, $id_conteudo, $id_questao;

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
}

?>