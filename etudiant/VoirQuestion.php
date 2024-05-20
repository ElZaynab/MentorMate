<?php include '../include/header.php'; ?>

<?php
if (isset($_GET['topic'])) {
  $topicId = $_GET['topic'];
  require("../connexion.php");

  $query = "SELECT name FROM topics WHERE id = :topicId";
  $stmt = $conn->prepare($query);
  $stmt->execute([':topicId' => $topicId]);
  $topic = $stmt->fetch(PDO::FETCH_ASSOC);

  $query = "SELECT * FROM questions WHERE topic_id = :topicId";
  $stmt = $conn->prepare($query);
  $stmt->execute([':topicId' => $topicId]);
  $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container mt-5">
  <h2>Questions pour le sujet: <?php echo htmlspecialchars($topic['name']); ?></h2>
  <button type="button" class="btn btn-primary mb-3" onclick="location.href='addQuestion.php?topic=<?php echo $topicId; ?>'">Créer une nouvelle question</button>
  <ul class="list-group">
    <?php
    if ($questions) {
      foreach ($questions as $question) {
        echo "<li class='list-group-item'>" . htmlspecialchars($question['title']) . "</li>";
      }
    } else {
      echo "<li class='list-group-item'>Aucune question trouvée pour ce sujet.</li>";
    }
    ?>
  </ul>
</div>

<?php include '../include/footer.php'; ?>
