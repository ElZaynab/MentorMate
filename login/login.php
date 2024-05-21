<?php
session_start();
$email = '';
$password = '';
$_SESSION['errVide'] = '';
$_SESSION['errConnexion'] = '';

if (isset($_POST["loginAdmin"])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (empty($email) || empty($password)) {
    $_SESSION['errVide'] = "Le remplissage des champs est obligatoire";
    header("Location: ../index.php");

  }

  // Vérifiez si les champs ne sont pas vides avant de continuer
  if (empty($_SESSION['errVide'])) {
    $query = "SELECT * FROM admin WHERE email = :email AND password = :password"; // Correction de l'espace
    include("../connexion.php");
    $stmt = $conn->prepare($query);
    $stmt->execute(array(":email" => $email, ":password" => $password));
    $data = $stmt->fetchAll();

    if (count($data) == 1) {
      $_SESSION["nomAmin"] = $data[0]["nom"];  // Correction de $_SEESION à $_SESSION
      $_SESSION["prenomAdmin"] = $data[0]["prenom"];
      header("Location: ../admin/dashboard.php");
      exit(); // Assurez-vous de stopper l'exécution après la redirection
    } else {
      $_SESSION['errConnexion'] = "L'email ou le mot de passe sont incorrects"; // Correction de l'orthographe
      header("location: ../index.php");
    }
  }
}
?>
