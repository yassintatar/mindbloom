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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email1'];
    $passwordd = $_POST['password1'];

    try { 
        $req = $connx->prepare('SELECT * FROM user WHERE email = :email');
        $req->execute(['email' => $email]);
        $user = $req->fetch();

        // Direct password comparison without hashing
        if ($user && $user['password'] === $passwordd) {
            if ($user['role'] === 'admin') {
                header("Location: /www/yassin/view/formulaire/backoffice/view/index.php");
            } else {
                header("Location: /www/yassin/view/formulaire/View/userprofile.php?email=" . urlencode($email));
            }
            exit;
        } else {
            echo "Invalid Email or Password!";
        }
    } catch (PDOException $e) { 
        echo "Database error: " . $e->getMessage();
    }
}
?>
