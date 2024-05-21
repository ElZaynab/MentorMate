<?php
session_start();
/*if (!isset($_SESSION['nomAmin'])) {
    header("Location: ../index.php");
    exit();
}*/

require("../../connexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insertQuestion'])) {
    $contenu = $_POST['contenu'];
    $idDomaine = $_POST['idDomaine'];
    $date = date('Y-m-d H:i:s');
    $filePath = '';

    // Gestion du fichier uploadé
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $fileName = basename($_FILES['file']['name']);
        $filePath = 'uploads/' . $fileName;
        move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
    }

    // Insertion de la question dans la base de données
    $query = "INSERT INTO question (idDomaine, contenu, date, file) VALUES (:idDomaine, :contenu, :date, :file)";
    $stmt = $conn->prepare($query);
    $stmt->execute([':idDomaine' => $idDomaine, ':contenu' => $contenu, ':date' => $date, ':file' => $filePath]);

    // Récupération de l'ID de la question insérée
    $questionId = $conn->lastInsertId();

    // Redirection vers la page d'affichage de la question
    header("Location: ../afficherQuestion.php?id=$questionId");
    exit();
}
?>
