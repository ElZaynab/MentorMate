<?php
session_start();
if (isset($_SESSION['nomEtudiant'])) {
    $username = $_SESSION['nomEtudiant'];
} else {
    header("Location: ../index.php");
    exit();
}
?>

<?php include '../include/header.php'; ?>

<!-- Page pour choisir un sujet -->
<div class="container mt-5">
  <h2>Choisir un sujet</h2>
  <form action="voirQuestion.php" method="get">
    <div class="form-group">
      <label for="topic">Sélectionner un sujet</label>
      <select name="topic" id="topic" class="form-select" required>
        <option value="">Sélectionner un sujet</option>
        <?php
        require("../connexion.php");
        $query = "SELECT * FROM domaineexpertise";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
          foreach ($result as $row) {
            echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['libelle']) . "</option>";
          }
        } else {
          echo "<option value=''>Aucune donnée trouvée dans la base de données.</option>";
        }
        ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Voir les questions</button>
  </form>
</div>

<?php include '../include/footer.php'; ?>
