<?php
    $page = 'edit';

    include_once "./common/header.php";
    include_once './data/datafile.php';

    $id = (isset($_GET['id']) && !empty($_GET['id']) )? $_GET['id']:null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = (isset($_POST['id']) && !empty($_POST['id']) )? $_POST['id']:null;
        if ($id &&  getCarById($id)){
            $marque_update = (isset($_POST['marque']) && !empty($_POST['marque']) )? $_POST['marque']:null;
            $modele = (isset($_POST['modele']) && !empty($_POST['modele']) )? $_POST['modele']:null;
            $annee = (isset($_POST['annee']) && !empty($_POST['annee']) )? $_POST['annee']:null;
            $couleur = (isset($_POST['couleur']) && !empty($_POST['couleur']) )? $_POST['couleur']:null;
            if ($marque_update && $modele && $annee && $couleur){
                $update = updateCar($id, $marque_update, $modele,$annee, $couleur);
                if ($update){
                    header("Location: /index.php");
                    exit;
                }
            }
        }
    }




    $car = getCarById($id);
?>

<div class="container-fluid">
    <div class="row justify-content-center">
		<div class="col-12 text-center" style="font-size : 50px; font-weight: bolder">
            Modifier la voiture
        </div>
		<div class="col-12 row justify-content-center">
            <form method="post" action="edit.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <div>
                    <label>Marque : </label>
                    <?php selectMarque(); ?>
                </div>
                <div>
                    <label>Modèle : </label>
                    <input type="text" name="modele" value="<?php if($car && $car["modele"]) echo $car["modele"];?>"/>
                </div>
                <div>
                    <label>Année : </label>
                    <input type="text" name="annee" value="<?php if($car && $car["annee"]) echo ($car["annee"]);?>" placeholder="En chiffre uniquement"/>
                </div>
                <div>
                    <label>Couleur : </label>
                    <?php selectCouleur(); ?>
                </div>
                <div>
                    <button class="btn btn-success" type="submit">Modifier</button>
                </div>
            </form>
        <div>
	</div>  
</div>

<?php 
include "./common/footer.php"
?>