<?php
include "../db/database.php";

function db_connexion(){
   try {
        $base = new PDO('mysql:host=localhost; dbname=myvoitures','wordpress','po#34papo');
    }
    catch(exception $e) {
        die('Erreur '.$e->getMessage());
    }
    $base->exec("SET NAMES utf8");
    
    return $base;
}

function login_exec($identifiant, $password){
 //   session_start();
    
    $con = db_connexion();
    $query = $con->prepare("SELECT * FROM `users` WHERE name= :identifiant AND password= :password;");
    $query->execute(array(':identifiant' => $identifiant, ':password' => md5($password)));
    $count = $query->rowCount();
    if($count == 1){
        
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION["userId"] = $row["id_user"];
            $_SESSION["userUsername"] = $row["name"];
            $_SESSION["userEmail"] = $row["email"];
        }
    }
    return $count == 1;
}

function createCar($marque_create , $modele , $annee, $couleur, $logo){
    $con = db_connexion();
    $logo = logoChoice($marque_create);
    $query= "INSERT INTO cars (id, marque_id, modele, annee, couleur_id, logo_id) 
            VALUES (NULL, :marque, :modele, :annee, :couleur, :logo);";
    $row=$con->prepare($query);
    $result = $row->execute(array(':marque'=>$marque_create, ':modele'=>$modele, ':annee'=>$annee, ':couleur'=>$couleur, ':logo'=>$logo));

    return $result;
}

function readCar(){ 
    $con = db_connexion();
    $query= "SELECT * FROM cars INNER JOIN marques ON cars.marque_id = marques.id_marque INNER JOIN colors ON cars.couleur_id = colors.id_color INNER JOIN images ON cars.logo_id=images.id_img";

    $result = $con->query($query);
    
    while ($data =$result->fetch(PDO::FETCH_ASSOC)) {
        $marque = $data['marque'];
        $modele = $data['modele'];
        $annee = $data['annee'];
        $couleur = $data['couleur'];
        $logo = $data['image'];
        $id = $data['id'];

        ?>
        <tr class='row'>
        <td class='text-center col'> 
            <div class="col-6">
                <img class="img-fluid" src="images/<?php echo base64_decode($logo) ?>">
            </div> 
        </td>
        <td class='text-center col'> <?php echo $marque ?></td>
        <td class='text-center col'><?php echo $modele ?></td>
        <td class='text-center col'><?php echo $annee ?></td>
        <td class='text-center col'><?php echo $couleur ?></td>
        <?php if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true ){ ?>
        <td class=' col row no-gutters'>
        <form class='col-6' method='get' action='edit.php'><input type='hidden' name='id' value='<?php echo $id ?>'><button class='btn btn-primary' type='submit'>modifier</button></form>
        <form class='col-6' method='post' action='supprimer.php?id=<?php echo $id ?>'><button class='btn btn-danger' type='submit'>supprimer</button></form></td>
        </tr>
        <?php }
    }
    
    return $data;
}



function getCarById($id){
    $con = db_connexion();
    $query = $con->prepare("SELECT * FROM cars WHERE id= :id");
    $query->execute(array(':id'=>$id));
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function updateCar($id, $marque_update, $modele, $annee, $couleur){
    $con = db_connexion();
    $query = $con->prepare("UPDATE cars 
        SET marque_id = :marque, modele = :modele, annee = :annee, couleur_id = :couleur 
        WHERE id = :id;");
    $result = $query->execute(array(':id'=>$id, ':marque'=> $marque_update, ':modele'=>$modele, ':annee'=>$annee, ':couleur' =>$couleur)); 
    return $result; 
}

function deleteCar($id){
    $con = db_connexion();
    $query = $con->prepare("DELETE FROM cars WHERE id = :id;");
    $result = $query->execute(array(":id"=>$id));
    return $result;
}

function selectMarque(){
    $con = db_connexion();
    $query= "SELECT * FROM marques";

    $result = $con->query($query);
    echo "<select name='marque'>";
    while ($data =$result->fetch(PDO::FETCH_ASSOC)) {
        $marque = $data['marque'];
        $id=$data['id_marque'];
        echo "<option value='".$id."'>".$marque."</option>";
    }
    echo "</select>";
    
    return $data;
}

function selectCouleur(){
    $con = db_connexion();
    $query= "SELECT * FROM colors";

    $result = $con->query($query);
    echo "<select name='couleur'>";
    while ($data =$result->fetch(PDO::FETCH_ASSOC)) {
        $couleur = $data['couleur'];
        $id=$data['id_color'];
        echo "<option value='".$id."'>".$couleur."</option>";
    }
    echo "</select>";
    
    return $data;
}

function createImg($image){
    $con = db_connexion();
    $query= "INSERT INTO images (id_img, image) 
            VALUES (NULL, :image);";
    $row=$con->prepare($query);
    $result = $row->execute(array(':image'=>$image));

    return $result;
}
function readImg(){ 
    $con = db_connexion();
    $query= "SELECT * FROM images";

    $result = $con->query($query);
    
    while ($data =$result->fetch(PDO::FETCH_ASSOC)) {
        $image = $data['image'];
        $id = $data['id_img'];

        ?>
        <div class="col-2">
            <img class="img-fluid" src="images/<?php echo base64_decode($image) ?>">
        </div>          
        <?php 
    }
    
    return $data;
}

function logoChoice($marque_create){
    if ($marque_create == "1"){
        $logo = "34";
    } elseif ($marque_create == "2"){
        $logo = "35";
    } elseif ($marque_create == "4"){
        $logo = "36";
    } elseif ($marque_create == "6"){
        $logo = "37";
    } elseif ($marque_create == "7"){
        $logo = "38";
    } elseif ($marque_create == "9"){
        $logo = "39";
    } elseif ($marque_create == "10"){
        $logo = "40";
    } elseif ($marque_create == "12"){
        $logo = "41";
    } elseif ($marque_create == "13"){
        $logo = "42";
    } elseif ($marque_create == "14"){
        $logo = "43";
    } elseif ($marque_create == "15"){
        $logo = "44";
    }
    if (isset($logo)) {
        return $logo;
    }
    
}

