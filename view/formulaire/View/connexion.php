<?php
$serveurname="localhost";
$username="root";
$password="";
$dbname="formulaire";
try
{
$connx=new PDO("mysql:host=$serveurname;dbname=$dbname",$username,$password);
}
catch(Expectations $e)
{
    die('Erreur :'.$e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $namelastname=$_POST['name'];
    $gender=$_POST['gender'];
    $dn=$_POST['date'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $passwordd=($_POST['password']);
    $role="user";

try{ 
    $req=$connx->prepare('INSERT INTO user VALUES(:namelastname,:gender,:dn,:phone,:email,:passwordd,:role)');
    $req->execute
    ([
        ':namelastname' => $namelastname,
        ':email' => $email,
        ':dn' => $dn,
        ':phone' => $phone,
        ':passwordd' => $passwordd,
        ':gender' => $gender,
        ':role' => $role
    ]);
    echo "Data successfully inserted!";
    
}
catch (PDOException $e) { 
    echo "Database error: " . $e->getMessage();
}
}

?>