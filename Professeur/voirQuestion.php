<?php
session_start();
/**if (!isset($_SESSION['nomProfesseur'])) {
    header("Location: ../index.php");
    exit();
}*/

if (isset($_GET['topic'])) {
    $topicId = $_GET['topic'];
    require("../connexion.php");

    $query = "SELECT libelle FROM domaineexpertise WHERE id = :topicId";
    $stmt = $conn->prepare($query);
    $stmt->execute([':topicId' => $topicId]);
    $topic = $stmt->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT * FROM question WHERE idDomaine = :topicId";
    $stmt = $conn->prepare($query);
    $stmt->execute([':topicId' => $topicId]);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php include '../include/header.php'; ?>

<div class="container mt-5">
  <h2>Questions pour le domaine : <?php echo htmlspecialchars($topic['libelle']); ?></h2>
  <ul class="list-group">
    <?php
    if ($questions) {
      foreach ($questions as $question) {
        echo "<li class='list-group-item'>";
        echo "<a href='afficherQuestion.php?id=" . htmlspecialchars($question['id']) . "'>" . htmlspecialchars($question['contenu']) . "</a>";
        echo "</li>";
      }
    } else {
      echo "<li class='list-group-item'>Aucune question trouvée pour ce domaine.</li>";
    }
    ?>
  </ul>
</div>

<?php include '../include/footer.php'; ?>
