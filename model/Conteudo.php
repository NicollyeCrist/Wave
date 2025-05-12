<?php

class Conteudo {
    private $idconteudo;
    private $tituloConteudo;
    private $decricao;
    private $linkConteudo;

    public function getIdConteudo() {
        return $this->idconteudo;
    }

    public function setIdConteudo($idconteudo) {
        $this->idconteudo = $idconteudo;
    }

    public function getTitulo() {
        return $this->tituloConteudo;
    }

    public function setTitulo($tituloConteudo) {
        $this->tituloConteudo = $tituloConteudo;
    }

    public function getDecricao() {
        return $this->tituloConteudo;
    }

    public function setDecricao($decricao) {
        $this->decricao = $decricao;
    }

    public function getLinkConteudo() {
        return $this->tituloConteudo;
    }

    public function setLinkConteudo($linkConteudo) {
        $this->linkConteudo = $linkConteudo;
    }
}

?>