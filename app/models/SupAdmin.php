<?php

class SupAdmin {
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $photo;

    public function __construct($nom, $prenom, $email, $password, $photo) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->photo = $photo;
    }

    public function authentifier($email, $password) {
        // Logique d'authentification
        // Dans une application réelle, on vérifierait les informations d'identification contre une base de données
        return ($this->email === $email && $this->password === $password);
    }
}

?>