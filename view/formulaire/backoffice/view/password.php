<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulaire";

try {
    
    $connx = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password2'], $_POST['password3'])) {
        $password2 = $_POST['password2'];
        $password3 = $_POST['password3'];
        // verif password
        if ($password2 !== $password3) {
            echo "<script>alert('Passwords do not match!');</script>";
            exit;
        }

        //crypted password
        //**$hashedPassword = password_hash($password2, PASSWORD_BCRYPT);

        try {
            // Update the password in database
            $stmt = $connx->prepare("UPDATE user SET password = :password WHERE email = :email");
            $stmt->execute([
                'password' => $password2,//**/
                'email' => $_GET['email']
            ]);

            echo "<script>alert('Password updated successfully!');</script>";
            header("Location: /www/psycholgy/view/formulaire/backoffice/view/adminprofile.php");
            exit;
        } catch (Exception $e) {
            die('Error updating password: ' . $e->getMessage());
        }
    } else {
        echo "<script>alert('All fields are required.');</script>";
    }
}
?>
