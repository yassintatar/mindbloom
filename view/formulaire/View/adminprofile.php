<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminpage.css">
    <link rel="stylesheet" href="formulaire.css">
    <link rel="stylesheet" href="navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
      h1
      {
        margin-left:50px;
        margin-bottom:-70px;
        margin-top:40px;
      }
      #table
      {
        margin-left:50px;
        margin-top: 90px;
        width: 90%; /* Set table width to 80% of the parent container */
        height: 150px; /* Set the height to 400px */
        border: 2px solid black; /* Optional: Add a border for visibility */
        border-collapse: collapse;
        
      }
      tr
      {
        border: 2px solid black; 
        text-align:center;
      }
      td ,th
      {
        border: 2px solid black; 
      }
      button
      {
        background-color:  #30b7bb;
        color: #fff;
        padding: 6px 12px ;
        border: 1px solid transparent;

        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-top: 10px;
        cursor: pointer;
        margin-bottom:10px;
      }
      #del
      {
        background-color:rgb(189, 58, 49);
        color: #fff; 
        margin-left:5px;s
      }
      #container 
      {
        background-color: #fff;
        border-radius: 30px;
        box-shadow: 0 5px 10px  #20F0E8(0, 0, 0, 0.35);
        position: relative;
        overflow: hidden;
        width: 1000px;
        max-width: 110%;
        min-height: 570px;
        margin: 20px 0;
        margin-top: 120px;
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
            <a href="../index.html" class="active">Home</a></li>
                <a href="#about">About</a></li>
                <a href="#services">Services</a></li>
                <a href="#formation">Formation</a></li>
                <a href="formulaire.html">Log in</a></li>
                
                
                <a href="#" id="content"><span>Content <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                    <path d="M1.293 4.293a1 1 0 0 1 1.414 0L8 9.586l5.293-5.293a1 1 0 1 1 1.414 1.414l-6 6a1 1 0 0 1-1.414 0l-6-6a1 1 0 0 1 0-1.414z"/>
                  </svg></span></a>
                
                  <ul id="compte">
                    <li><a href="#" >Compte</a></li>
                    <li class="dropdown"><a href="#">Cours</a>
                      <ul id="module">
                        <li><a href="#">Module 1</a></li>
                        <li><a href="#">Module 2</a></li>
                        <li><a href="#">Module 3</a></li>
                        <li><a href="#">Module 4</a></li>
                        <li><a href="#">Module 5</a></li>
                      </ul>
                    </li>
                    <li><a href="test.html">Test</a></li>
                    <li><a href="#">Bibliothèque meditation </a></li>
                    <li><a href="#">Blogs</a></li>
                  </ul>
                </li>
                <a href="#contact">Contact</a>
        </nav>
    </header>
<div id="container">
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
  $req=$connx->prepare("SELECT * FROM user");
  $res=$req->execute();
  
  $utils=$req->fetchAll();
  
  ?>
  <h1>Admin Dashboard</h1>
  <table id="table">
    <tr>
      <th>User Name</th>
      <th>Role</th>
      <th>Gender</th>
      <th>Date </th>
      <th>Phone</th>
      <th>Email</th>
      <th>Operations</th>
    </tr>
    <?php foreach($utils as $util): ?><!--boucle foreach -->
    <tr>
      <td>
        <?= $util["name_lastname"]?><!--echo -->
      </td>
      <td>
        <?= $util["role"]?>
      </td>
      <td>
        <?= $util["genre"]?>
      </td>
      <td>
        <?= $util["dn"]?>
      </td>
      <td>
        <?= $util["phone"]?>
      </td>
      <td>
        <?= $util["email"]?>
      </td>
      <td>
      <a href="userprofile.php?email=<?= urlencode($util["email"]) ?>"><button id="mod">Modify</button></a>
       <a href="delete.php?email=<?= urlencode($util["email"]) ?>"><button id="del">Delete</button></a>
      </td>
    </tr>

    <?php endforeach; ?>
  </table>
    
</div>
</body>
</html>