<?php
$page = 'image';
$image = (isset($_POST['image']) && !empty($_POST['image']) )? base64_encode($_POST['image']):null;
include_once("./common/header.php");
include_once './data/datafile.php';
if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true) {
?>
<form method="POST" action="image.php">
    Choisis une image : <input type="file" name="image"><br><br>
    <button type="submit"> valider </button>
</form>
<?php } ?>
<div class="container-fluid">
    <div class="row mb-5">
        <?php
           createImg($image); 
            readImg();  
            
        ?>
    </div>
</div>
<?php
include "./common/footer.php";
?>