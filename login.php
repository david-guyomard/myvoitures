<?php 
$page = 'login';
$identifiant = (isset($_POST['identifiant'])   && !empty($_POST['identifiant']) )? $_POST['identifiant']:null;
$password = (isset($_POST['password'])   && !empty($_POST['password']) )? $_POST['password']:null;
$deconnexion = (isset($_GET['deconnexion'])   && !empty($_GET['deconnexion']) )? $_GET['deconnexion']:null;

include_once("./common/header.php");
if($deconnexion == true && $_SESSION['isConnected'] === true ){
    session_destroy();
    header('Location: /index.php');
}
?>
<div class="container-fluid">
    <div class="row content-row justify-content-center align-items-center">
        <div class="col-8 content-page content-login text-center">
            <div class="row mt-5">
                <div class="col-6 text-right">
                Se connecter
                </div>
<?php

if ($identifiant && $password){
    include_once './data/datafile.php';
    $connexion = login_exec($identifiant, $password);    
    if ($connexion){
        if (($_SESSION['isConnected'] !== true)) {
           /* session_start([
                'cookie_lifetime' => 86400,
            ]);*/
            $_SESSION['isConnected'] = true;
            $_SESSION['timeStamp'] = time();
            header('Location: /admin.php'); 
            exit;
        }
    }else{
        echo("<div class=\"col-12 alert alert-danger\">Le couple identifiant/mot de passe n'existe pas.</div>");
    }
}

if ( isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true ) {
    header('Location: /admin.php');
    exit;
}
?>
            </div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="row mt-3">
<?php
if (isset($_POST['identifiant']) && empty($_POST['identifiant'])){
    echo("<div class=\"col-12 alert alert-danger\">Veuillez remplir votre identifiant</div>");
}
?>
                <div class="col-6 text-right">Identifiant</div>
                <div class="col-6 text-left">
                    <input type="text" name="identifiant" autocomplete="Off" value="<?php if($identifiant) echo $identifiant;?>" />
                </div>
            </div>
            <div class="row mt-3">
<?php 
if (isset($_POST['password']) && empty($_POST['password'])){
    echo("<div class=\"col-12 alert alert-danger\">Veuillez remplir votre mot de passe</div>");
}
?>
                <div class="col-6 text-right">Mot de passe</div>
                <div class="col-6 text-left">
                    <input type="password" name="password" autocomplete="ON"/>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6"></div>
                <div class="col-6 text-left">
                    <button type="submit" class="brn btn-primary">S'identifier</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php include "./common/footer.php"; ?>