<?php
$page = 'Creer';
$marque_create = (isset($_POST['marque']) && !empty($_POST['marque']) )? $_POST['marque']:null;
$modele = (isset($_POST['modele']) && !empty($_POST['modele']) )? $_POST['modele']:null;
$annee = (isset($_POST['annee']) && !empty($_POST['annee']) )? $_POST['annee']:null;
$couleur = (isset($_POST['couleur']) && !empty($_POST['couleur']) )? $_POST['couleur']:null;


include_once "./common/header.php";
include_once './data/datafile.php';

$logo = logoChoice($marque_create);

if($marque_create && $modele && $annee && $couleur){
	$newCar = createCar($marque_create , $modele , $annee, $couleur, $logo);
	if($newCar){
		header ("Location: /index.php");
		exit;
	}
}	

/* 	1- Creer une nouvelle base de données avec une table permettant d'y stocker une playlist
		la commande sql suivante permet de creer cette table :
					
					CREATE TABLE musiques (
						id int AUTO_INCREMENT,
						album varchar(255),
						author varchar(255),
						title varchar(255),
						fav boolean,
						PRIMARY KEY (id)
					);

	pour inserer une donnée dans la table voici la commande SQL :
					INSERT INTO musiques (id, album, author, title, fav) 
					VALUES (NULL, 'Les années tubes des années 80', 'Début de soirée', 'Nuit de folie', false);


	pour modifier la donnée dans la table voici la commande SQL :
					UPDATE musiques 
					SET title = 'Nuit de folie !' 
					WHERE id = 1;
					
	pour lire une donnée de la table, voici la commande SQL :
					SELECT *
					FROM musiques
					
					WHERE id=1
					
	pour effacer une donnée de la table, voici la commande SQL :
					DELETE FROM musiques 
					WHERE id='1'
					
	


	2- 	Tester ces requetes dans la zone de requete SQL dans phpmyadmin
	
	3- 	Réaliser un site de listing de musique : mymusic.fr
	4- 	Ce site fictif affiche la liste des musiques présentent dans la table.
			- Il est possible d'en ajouter une.
			- Il est possible d'en modifier une.
			- Il est possible d'en supprimer une.
	
	
	
*/


?>

<div class="container-fluid">
    <div class="row justify-content-center">
		<div class="col-12 text-center" style="font-size : 50px; font-weight: bolder">
            Ajouter une nouvelle voiture
        </div>
		<div class="col-12 row justify-content-center">
		
			<form method="post" action="creer.php">
				<div>
					<label>Marque : </label>
					<?php selectMarque(); ?>
				</div>
				<div>
					<label>Modèle : </label>
					<input type="text" name="modele"/>
				</div>
				<div>
					<label>Année : </label>
					<input type="text" name="annee" placeholder="En chiffre uniquement"/>
				</div>
				<div>
					<label>Couleur : </label>
					<?php selectCouleur(); ?>
				</div>
				<div>
					<button class="btn btn-success" type="submit">Créer</button>
				</div>
			</form>
		<div>
	</div>  
</div>
<?php 
include "./common/footer.php"
?>