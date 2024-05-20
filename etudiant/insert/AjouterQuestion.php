<?php
require("../../connexion.php");

if (isset($_POST['insertQuestion'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $topicId = $_POST['topic_id'];
  
  $file = $_FILES['file'];
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileDestination = 'uploads/' . $fileName;
  
  if (move_uploaded_file($fileTmpName, $fileDestination)) {
    $query = "INSERT INTO questions (title, description, file, topic_id) VALUES (:title, :description, :file, :topicId)";
    $stmt = $conn->prepare($query);
    $stmt->execute([
      ':title' => $title,
      ':description' => $description,
      ':file' => $fileName,
      ':topicId' => $topicId
    ]);
    header("Location: ../viewQuestions.php?topic=" . $topicId);
  } else {
    echo "Erreur lors du téléchargement du fichier.";
  }
}
?>
