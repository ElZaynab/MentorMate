<?php
session_start();
require("../connexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reponse = $_POST['reponse'];
    $questionId = $_POST['questionId'];

    $query = "INSERT INTO reponse (contenu, idQuestion, date) VALUES (:contenu, :idQuestion, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ':contenu' => $reponse,
        ':idQuestion' => $questionId,
    ]);

    header("Location: afficherQuestion.php?id=$questionId");
    exit();
}
?>
