<?php include '../include/header.php'; ?>

<?php
if (isset($_GET['topic'])) {
  $topicId = $_GET['topic'];
}
?>

<div class="container mt-5">
  <h2>Ajouter une question</h2>
  <form action="insert/ajouterQuestion.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="idDomaine" value="<?php echo $topicId; ?>">
    <div class="form-group">
      <label>Contenu de la question</label>
      <input type="text" name="contenu" class="form-control" placeholder="Contenu de la question" required>
    </div>
    <div class="form-group">
      <label>Fichier/Image</label>
      <input type="file" name="file" class="form-control">
    </div>
    <button type="submit" name="insertQuestion" class="btn btn-primary">Créer la question</button>
  </form>
</div>

<?php include '../include/footer.php'; ?>
