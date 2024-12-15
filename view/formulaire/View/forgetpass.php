<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "formulaire";

// Establish database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Initialize error variables
$emailError = $passwordError1 = $passwordError2 = $successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password'], $_POST['password2'], $_POST['email'])) {
        $password = trim($_POST['password']);
        $password2 = trim($_POST['password2']);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

        // Store entered data in session
        $_SESSION['email'] = $email;

        // Check if email exists in the database
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($email=="" && $password=="" && $password2=="" )
        {
            $passwordError2 = 'Please Fill in all Fields';
        }

        elseif ($stmt->rowCount() === 0) {
            $emailError = ' This Email Dose not Exist !';
        } 
        
        elseif (empty($password2)) {
            $passwordError2 = 'Please enter the password!';
        } 
        
        elseif (empty($password)) {
            $passwordError1 = 'Please enter the password!';
        } 
        elseif($password != $password2)
        {
            $passwordError2 = 'Passwords  do not match!';
        }
        
        else {
            // Hash the password securely
            //$hashedPassword = password_hash($password2, PASSWORD_BCRYPT);

            // Update password in the database
            $stmt = $conn->prepare("UPDATE user SET password = :password WHERE email = :email");
            $stmt->execute([
                'password' => $password,
                'email' => $email
            ]);

            $successMessage = 'Password updated successfully!';
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link rel="stylesheet" href="formulaire.css">
    <link rel="stylesheet" href="navbar.css">
    <title>Change Password</title>

    <style>
        #container {
            width: 35%;
            height: 30vh;
            min-height: 450px;
            margin-top: 100px;
        }
        #passw {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 25%;
        }
        #h1 {
            margin-left: -30px;
            z-index: 99999;
            margin-bottom: 10px;
            margin-top: -50px;
        }
        #email2, #passwordp1, #passwordp2 {
            width: 150%;
        }
        #pe, #pp1, #pp2, #success {
            margin-left: -90px;
            margin-top: 3px;
            margin-bottom: 3px;
        }
        #pe, #pp1, #pp2 {
            color: red;
        }
        #success {
            color: green;
            margin-left:-50px;
            margin-right:-5px; 
        }
    </style>
</head>

<body id="body2">
    <header id="headerr">
        <div class="logo-container">
            <img src="mindbloom.png" width="115" id="logo" alt="Logo Mindbloom">
            <span class="logo-title">Mindbloom</span>
        </div>
        <nav>
            <a href="/www/yassin/view/indexhome.html">Home</a>
            <a href="../index.html">About</a>
            <a href="../index.html">Services</a>
            <a href="../index.html">Formation</a>
            <a href="formulaire.html">Log in</a>
            
            <a href="../index.html">Contact</a>
        </nav>
    </header>

    <div class="container" id="container">
        <div class="form-container sign-in" id="passw">
        <form method="POST">
                <h2 id="h1">To change your password insert :</h2>

                <input type="text" placeholder="Email" id="email2" name="email" 
                value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>">
                <p id="pe"><?php echo $emailError; ?></p>
                <input type="password" placeholder="Create Password" id="passwordp1" name="password">
                <p id="pp1"><?php echo $passwordError1; ?></p>
                <input type="password" placeholder="Confirm Password" id="passwordp2" name="password2">
                <p id="pp2"><?php echo $passwordError2; ?></p>
                <p id="success"><?php echo $successMessage; ?></p>

                <button type="submit" id="b2">Confirm</button>

                <?php unset($_SESSION['email']); ?>
            </form>
        </div>
    </div>

</body>
</html>
