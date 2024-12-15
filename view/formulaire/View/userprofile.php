<?php
$serveurname = "localhost";
$username = "root";
$password = "";
$dbname = "formulaire";
session_start(); // Start the session
$email = $_POST['email1'] ?? null; // Replace with your logic to retrieve the email

if ($email) {
    $_SESSION['email'] = $email; // Store email in session
}
try {
    $connx = new PDO("mysql:host=$serveurname;dbname=$dbname", $username, $password);
} catch (Exception $e) {
    die('Erreur :' . $e->getMessage());
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $req = $connx->prepare('SELECT * FROM user WHERE email = :email');
    $req->execute(['email' => $email]);
    $user = $req->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $namelastname = $_POST['name'];
        $gender = $_POST['gender'];
        $dn = $_POST['date'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $passwordd = $_POST['password'];
        $role = $_POST['role'];


        $req = $connx->prepare("UPDATE user SET 
            name_lastname = :name_lastname, 
            genre = :gender, 
            dn = :dn, 
            phone = :phone, 
            email = :email, 
            password = :passwordd, 
            role = :role 
            WHERE email = :email_id");
        $req->execute([
            'name_lastname' => $namelastname,
            'gender' => $gender,
            'dn' => $dn,
            'phone' => $phone,
            'email' => $email,
            'passwordd' => $passwordd,
            'role' => $role,
            'email_id' => $_GET['email']
        ]);
        
        header("Location: /www/yassin/view/indexsignin.html?email=" . urlencode($email));
        exit;
        
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userprofile.css">
    <link rel="stylesheet" href="navbar.css">
    
    <title>User Profile</title>
    <style>
        body 
        {
            background-color: #d2ffc9;
            background: linear-gradient(to right, #e2e2e2, #c9fffd);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 106vh;
        }
        .container 
        {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 10px  #20F0E8(0, 0, 0, 0.35);
            position: relative; 
            overflow: hidden;
            width: 1000px;
            max-width: 100%;
            min-height: 650px;
            margin: 20px 0;
            margin-top: 190px;
            margin-bottom: 20px ;
 
        }   
        #container input
        {
            border: 1px solid #ccc;
            margin: -20px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
            margin-bottom:-4px;
            margin-top:-25px;
        
        }
        #container p
        {
            margin-top:20px;
            margin-bottom:30px;
            
        }
        h1
        {
            margin-top: 5px;
            margin-bottom: -5px;
        }
        .form-container
        {
            height:115%;
        }
        #username
        {
            margin-left:90px;
        }

    </style>
</head>
<body>
    <header id="headerr">
        <div class="logo-container">
            <img src="mindbloom.png" width="115" id="logo" alt="Logo Mindbloom">
            <span class="logo-title">Mindbloom</span>
        </div>
        <nav>
            



            <a href="/www/yassin/view/indexhome.html">Log out</a>

        
        </nav>
    </header>

    <div class="container" id="container">
        <img src="profilepic.jpg" alt="" id="img">
        <h3 id="username"><?= htmlspecialchars($user['name_lastname'] ?? '') ?></h3>
        <div class="form-container sign-in">
            
            <form method="POST">
                <h1>Your Profile</h1>
                <p>User Name:</p>
                
                <input type="text" name="name" value="<?= htmlspecialchars($user['name_lastname'] ?? '') ?>">
                <p>Email:</p>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" >
                <p>Phone Number:</p>
                <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                <p>Gender:</p>
                <input type="text" name="gender" value="<?= htmlspecialchars($user['genre'] ?? '') ?>">
                <p>Date of Birth:</p>
                <input type="date" name="date" value="<?= htmlspecialchars($user['dn'] ?? '') ?>">
                <p>Role:</p>
                <input type="text" name="role" value="<?= htmlspecialchars($user['role'] ?? '') ?>">
                <p>Password:</p>
                <input type="password" name="password" value="<?= htmlspecialchars($user['password'] ?? '') ?>" >
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>
</body>
</html>
