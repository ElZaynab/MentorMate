<?php include '../include/header.php'; ?>

<?php
if (isset($_GET['topic'])) {
  $topicId = $_GET['topic'];
}
?>

<div class="container mt-5">
  <h2>Ajouter une question</h2>
  <form action="insert/addQuestion.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="topic_id" value="<?php echo $topicId; ?>">
    <div class="form-group">
      <label>Titre de la question</label>
      <input type="text" name="title" class="form-control" placeholder="Titre de la question" required>
    </div>
    <div class="form-group">
      <label>Description de la question</label>
      <textarea name="description" class="form-control" placeholder="Description" required></textarea>
    </div>
    <div class="form-group">
      <label>Fichier/Image</label>
      <input type="file" name="file" class="form-control">
    </div>
    <button type="submit" name="insertQuestion" class="btn btn-primary">Créer la question</button>
  </form>
</div>

<?php include '../include/footer.php'; ?>
