<?php 
    $page = 'voitures';
    include_once("./common/header.php");
    include_once './data/datafile.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center" style="font-size : 50px; font-weight: bolder">
            Ma liste de voiture
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11 row">
            <table class="col-12 table table-striped table-hover">
                <thead>
                    <tr class="row">
                        <th class="text-center col">Logo</th>
                        <th class="text-center col">Marque</th>
                        <th class="text-center col">Modèle</th>
                        <th class="text-center col">Année</th>
                        <th class="text-center col">Couleur</th>
                    <?php if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true ){ ?>
                        <th class="text-center col">Actions</th>
                    <?php } ?>
                    </tr>
                </thead>
                <tbody>
                <?php readCar();?>
                </tbody>
            </table>
        </div>
        <?php if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true ){ ?>
        <div class="col-12 row mb-5 justify-content-center">
            <form method='post' action='creer.php'><button class='btn btn-success' type='submit'>Ajouter</button></form>
        </div>
        <?php } ?>
    </div>  
</div>
<?php 
include "./common/footer.php"; 
?>