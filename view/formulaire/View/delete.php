<?php
$serveurname = "localhost";
$username = "root";
$password = "";
$dbname = "formulaire";

try {
    $connx = new PDO("mysql:host=$serveurname;dbname=$dbname", $username, $password);
} catch (Exception $e) {
    die('Erreur :' . $e->getMessage());
}

// Verifier l'email 
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Supprimer l'utilisateur
    $req = $connx->prepare("DELETE FROM user WHERE email = :email");
    $req->execute(['email' => $email]);

       
    header("Location: /www/psycholgy/view/formulaire/adminprofile.php");
    exit;
} else {
    die('Aucun email fourni pour la suppression !');
}
?>
