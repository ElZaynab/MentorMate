<?php
session_start();

require("../connexion.php");

if (isset($_GET['id'])) {
    $questionId = $_GET['id'];

    // Récupération de la question
    $query = "SELECT * FROM question WHERE id = :questionId";
    $stmt = $conn->prepare($query);
    $stmt->execute([':questionId' => $questionId]);
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupération des réponses associées à la question
    $query = "SELECT * FROM reponse WHERE idQuestion = :questionId";
    $stmt = $conn->prepare($query);
    $stmt->execute([':questionId' => $questionId]);
    $reponses = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php include '../include/header.php'; ?>

<div class="container mt-5">
  <h2>Question : <?php echo htmlspecialchars($question['contenu']); ?></h2>
  <p>Date : <?php echo htmlspecialchars($question['date']); ?></p>
  <?php if (!empty($question['file'])): ?>
    <?php
    $filePath = "insert/uploads/" . basename($question['file']); // Construire le chemin complet du fichier
    if (file_exists($filePath)): // Vérifier si le fichier existe
    ?>
      <p>Fichier : <a href="<?php echo htmlspecialchars($filePath); ?>" download="<?php echo basename($question['file']); ?>">Télécharger</a></p>
    <?php else: ?>
      <p>Fichier non trouvé.</p>
    <?php endif; ?>
  <?php endif; ?>

  <h3>Réponses</h3>
  <?php if (!empty($reponses)): ?>
    <ul>
      <?php foreach ($reponses as $reponse): ?>
        <li>
          <p><?php echo htmlspecialchars($reponse['contenu']); ?></p> <!--Prof ou etudiant-->
          <p>Date de publication : <?php echo htmlspecialchars($reponse['date']); ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>Aucune réponse pour cette question.</p>
  <?php endif; ?>

  <h3>Ajouter une réponse</h3>
  <form action="insertReponse.php" method="post">
    <div class="form-group">
      <label for="reponse">Votre réponse</label>
      <textarea name="reponse" id="reponse" class="form-control" required></textarea>
    </div>
    <input type="hidden" name="questionId" value="<?php echo htmlspecialchars($questionId); ?>">
    <button type="submit" class="btn btn-primary">Envoyer la réponse</button>
  </form>
</div>

<?php include '../include/footer.php'; ?>
