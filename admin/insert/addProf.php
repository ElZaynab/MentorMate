<?php
session_start();
require("../../connexion.php");

$nom = '';
$prenom = '';
$email = '';
$password = '';
$domaine = '';
$image = '';
$_SESSION['errVide'] = '';
$_SESSION['confirmation'] = '';

if (isset($_POST["insertProf"])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash du mot de passe
    $domaine = $_POST['domaine'];

    if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($domaine)) {
        $_SESSION['errVide'] = "Le remplissage des champs est obligatoire";
        header("Location: ../GestionProf.php");
        exit();
    }

    // Gestion du téléchargement de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        if (in_array($filetype, $allowed)) {
            $image = 'uploads/' . uniqid() . '.' . $filetype;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
                $_SESSION['error'] = "Erreur lors du téléchargement de l'image.";
                header("Location: ../GestionProf.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Type de fichier non autorisé.";
            header("Location: ../GestionProf.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Erreur lors du téléchargement de l'image.";
        header("Location: ../GestionProf.php");
        exit();
    }

    // Insertion des données dans la base de données
    $query = "INSERT INTO prof (nom, prenom, email, password, image) VALUES (:nom, :prenom, :email, :password, :image)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':image', $image);

    if ($stmt->execute()) {
        // Récupérer l'ID du professeur nouvellement inséré
        $profId = $conn->lastInsertId();

        // Insertion dans la table enseigner
        $query = "INSERT INTO enseigner (idProf, idDomaine) VALUES (:idProf, :idDomaine)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':idProf', $profId);
        $stmt->bindParam(':idDomaine', $domaine);

        if ($stmt->execute()) {
            $_SESSION['confirmation'] = "Le professeur a été ajouté avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout du domaine d'expertise.";
        }
    } else {
        $_SESSION['error'] = "Une erreur est survenue lors de l'ajout du professeur.";
    }

    header("Location: ../GestionProf.php");
    exit();
}
?>
