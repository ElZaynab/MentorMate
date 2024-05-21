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
  <h2 id="questionTitle">
    Question : <?php echo htmlspecialchars($question['contenu']); ?>
  </h2>
  <p>Date : <?php echo htmlspecialchars($question['date']); ?></p>
  <?php if (!empty($question['file'])): ?>
    <?php
    $filePath = "../Etudiant/insert/uploads/" . basename($question['file']);
    if (file_exists($filePath)): ?>
      <p>Fichier : <a href="<?php echo htmlspecialchars($filePath); ?>" download="<?php echo basename($question['file']); ?>">Télécharger</a></p>
    <?php else: ?>
      <p>Fichier non trouvé.</p>
    <?php endif; ?>
  <?php endif; ?>

  <h3>Réponses</h3>
  <?php if (!empty($reponses)): ?>
    <ul class="list-group">
      <?php foreach ($reponses as $reponse): ?>
        <li class="list-group-item">
          <p><?php echo htmlspecialchars($reponse['contenu']); ?></p>
          <p>Date de publication : <?php echo htmlspecialchars($reponse['date']); ?></p>
          <p><strong>Réponse de l'étudiant/professeur</strong></p>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>Aucune réponse pour cette question.</p>
  <?php endif; ?>

  <button type="button" class="btn btn-success" id="marquerResolu">Marquer comme résolue</button>

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

<script>
document.addEventListener('DOMContentLoaded', (event) => {
  const marquerResoluButton = document.getElementById('marquerResolu');
  marquerResoluButton.addEventListener('click', () => {
    const questionTitle = document.getElementById('questionTitle');
    questionTitle.classList.add('text-success');
    questionTitle.innerHTML += ' <span class="badge bg-success">[Résolu]</span>';
    marquerResoluButton.remove();

    // Désactiver le formulaire de réponse
    const responseForm = document.querySelector('form');
    responseForm.querySelector('textarea').disabled = true;
    responseForm.querySelector('button[type="submit"]').disabled = true;
  });
});
</script>

<?php include '../include/footer.php'; ?>
