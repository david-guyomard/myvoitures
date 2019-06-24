<?php 
$page = 'admin';
include_once("./common/header.php");
if($_SESSION['isConnected'] !== true ){
    header('Location: /login.php');
}
?>
<div class="container-fluid">
    <div class="row content-row justify-content-center align-items-center">
        <div class="col-8 content-page content-accueil text-center">
            <div class="col">Bienvenue <?php  echo ucfirst($_SESSION["userUsername"]); ?> !</div>
            <div class="col"> Vous êtes dans votre espace sécurisé.</div>
            <div class="col"> Que voulez-vous faire ?</div>
            
        </div>
    </div>
</div>
<?php include "./common/footer.php"; ?>