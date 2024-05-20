<!-- Include your header and any necessary dependencies -->
<?php include '../include/header.php'; ?>

<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Ajouter prof</button>

<!-- Modal for adding professor -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Ajouter un prof</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="insert/addProf.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Le nom</label>
            <input type="text" name="nom" class="form-control" placeholder="le nom" required>
          </div>
          <div class="form-group">
            <label>Le prenom</label>
            <input type="text" name="prenom" class="form-control" placeholder="le prenom" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="email" required>
          </div>
          <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" placeholder="mot de passe" required>
          </div>
          <div class="form-group">
            <label>Photo</label>
            <input type="file" name="image" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Le domaine d'expertise</label>
            <select name="domaine" class="form-select" required>
              <option value="">Sélectionner un domaine</option>
              <?php
              require("../connexion.php");
              $query = "SELECT * FROM domaineexpertise";
              $stmt = $conn->query($query);
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              if ($result) {
                foreach ($result as $row) {
                  echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nom']) . "</option>";
                }
              } else {
                echo "<option value=''>Aucune donnée trouvée dans la base de données.</option>";
              }
              ?>
            </select>
          </div>


      </div>
      <div class="modal-footer">
        <button type="submit" name="insertProf" class="btn btn-primary">Envoyer</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </form>  
    </div>
  </div>
</div>

<!-- Include your footer -->
<?php include '../include/footer.php'; ?>
