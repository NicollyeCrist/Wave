<?php

class Questoes{
    private $idquestao, $enunciado, $idconteudo;

    public function getIdQuestao() {
        return $this->idquestao;
    }

    public function setIdQuestao($idquestao) {
        $this->idquestao = $idquestao;
    }

    public function getEnunciado() {
        return $this->enunciado;
    }

    public function setEnunciado($enunciado) {
        $this->enunciado = $enunciado;
    }

    public function getIdConteudo() {
        return $this->idconteudo;
    }

    public function setIdConteudo($idconteudo) {
        $this->idconteudo = $idconteudo;
    }
}

?>