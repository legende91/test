<?php

namespace Blog\Entity;

class Article {
    protected $id;
    protected $titre;
    protected $datePub;
    protected $contenu;
    protected $photo;
    protected $membreId;
    
    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDatePub() {
        return $this->datePub;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getMembreId() {
        return $this->membreId;
    }

    public function setId($id) {
        $this->id = (int) $id;
        return $this;
    }

    public function setTitre($titre) {
        $this->titre = (string) $titre;
        return $this;
    }

    public function setDatePub($datePub) {
        $this->datePub = (string) $datePub;
        return $this;
    }

    public function setContenu($contenu) {
        $this->contenu = (string) $contenu;
        return $this;
    }

    public function setPhoto($photo) {
        $this->photo = (string) $photo;
        return $this;
    }

    public function setMembreId($membreId) {
        $this->membreId = (int) $membreId;
        return $this;
    }

}
