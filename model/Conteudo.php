<?php

class Conteudo {
    private $id;
    private $titulo;
    private $descricao;
    private $idDisciplina;
    private $links;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getIdDisciplina() {
        return $this->idDisciplina;
    }

    public function setIdDisciplina($idDisciplina) {
        $this->idDisciplina = $idDisciplina;
    }

    public function getLinks() {
        return $this->links;
    }

    public function setLinks($links) {
        if (is_array($links)) {
            $this->links = json_encode($links);
        } else {
            $this->links = $links;
        }
    }

    public function getLinksArray() {
        if (is_string($this->links)) {
            return json_decode($this->links, true);
        }
        return $this->links;
    }
}

?>