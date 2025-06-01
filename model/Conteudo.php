<?php

class Conteudo {
    private $id;
    private $tituloConteudo;
    private $descricao;
    private $linkConteudo;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->tituloConteudo;
    }

    public function setTitulo($tituloConteudo) {
        $this->tituloConteudo = $tituloConteudo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getLinkConteudo() {
        return $this->linkConteudo;
    }

    public function setLinkConteudo($linkConteudo) {
        $this->linkConteudo = $linkConteudo;
    }
}

?>