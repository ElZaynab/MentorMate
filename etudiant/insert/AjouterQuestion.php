<?php
require("../connexion.php");

if (isset($_POST['insertQuestion'])) {
  $idDomaine = $_POST['idDomaine'];
  $contenu = $_POST['contenu'];
  $file = '';

  if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $file = 'uploads/' . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $file);
  }

  $query = "INSERT INTO question (idDomaine, contenu, date, file) VALUES (:idDomaine, :contenu, NOW(), :file)";
  $stmt = $conn->prepare($query);
  $stmt->execute([
    ':idDomaine' => $idDomaine,
    ':contenu' => $contenu,
    ':file' => $file
  ]);

  header("Location: ../voirQuestion.php?topic=" . $idDomaine);
  exit();
}
?>
