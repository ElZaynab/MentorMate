<?php
session_start();
if (!isset($_SESSION['nomAmin'])) {
    header("Location: ../index.php");
    exit();
}

require("../connexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reponse = $_POST['reponse'];
    $questionId = $_POST['questionId'];
    $date = date('Y-m-d H:i:s');

    // Insertion de la réponse dans la base de données
    $query = "INSERT INTO reponse (idQuestion, contenu, date) VALUES (:idQuestion, :contenu, :date)";
    $stmt = $conn->prepare($query);
    $stmt->execute([':idQuestion' => $questionId, ':contenu' => $reponse, ':date' => $date]);

    // Redirection vers la page de la question
    header("Location: afficherQuestion.php?id=$questionId");
    exit();
}
?>
