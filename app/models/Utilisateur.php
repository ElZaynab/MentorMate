<?php

require_once 'SupAdmin.php';

class Utilisateur extends SupAdmin {
    public function __construct($nom, $prenom, $email, $password, $photo) {
        parent::__construct($nom, $prenom, $email, $password, $photo);
    }

    public function repondreQuestion ($question, $reponse) {
        // Logique pour répondre à une question
        // Par exemple, enregistrer la réponse dans une base de données
        return "Réponse à la question '{$question}': {$reponse}";
    }
}

?>