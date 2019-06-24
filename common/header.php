<?php 
$title = 'Myvoitures - '.$page;
session_start([
  'cookie_lifetime' => 86400,
]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
      .rightpos{
        right:0px;
      }
      .footer{
        position: fixed;
        bottom: 0px;
      }
    </style>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title><?php echo $title; ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="#">
<?php echo('Bienvenue sur Myvoitures ') ?>
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse navbar-light bg-light" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link <?php if($page == 'voitures'){ echo "active";}?>" href="index.php">Voitures</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php if($page == 'image'){ echo "active";}?>" href="image.php">Image</a>
    </li>
    <?php 
       if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true ) {
    ?>
    <li class="nav-item">
      <a class="nav-link <?php if($page == 'Creer'){ echo "active";}?>" href="creer.php">Creer</a>
    </li>
    <li class="nav-item">
    <li class="nav-item <?php if($page == 'admin'){ echo "active";}?>">
        <a class="nav-link" href="admin.php">Admin</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="login.php?deconnexion=true">Se déconnecter</a>
    </li>
   <?php  
       }else{
   ?>
       <li class="nav-item rightpos <?php if($page == 'login'){ echo "active";}?>">
           <a class="nav-link" href="login.php">Se connecter</a>
       </li>
   <?php
       }
   ?>
     
   </li>
    
  </ul>
  <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</div>
</nav>


