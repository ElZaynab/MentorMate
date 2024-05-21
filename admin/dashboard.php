<?php session_start();
if (isset($_SESSION['nomAmin'])) {
    $username = $_SESSION['nomAmin'];
}
else {
    header("Location: ../index.php");
    exit();
}
?>
<?php include  '../include/header.php'; ?>
<a href="GestionProf.php">Prof</>
<?php include  '../include/footer.php'; ?>
