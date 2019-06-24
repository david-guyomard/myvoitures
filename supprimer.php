<?php 
$Id = (isset($_GET['id'])   && !empty($_GET['id']) )? $_GET['id']:null;
include_once './data/datafile.php';
if ($Id && getCarById($Id)){
    deleteCar($Id);
}

header('Location: /index.php');
exit;

?>