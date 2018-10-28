<?php
// Récupération des données de configuration
$config = parse_ini_file('../config/config.ini');

$sexe = $_POST['sexe'];
$categorie = $_POST['categorie'];
$couleur = $_POST['couleur'];
$nouveauFichier =  strtolower($config['upload_dir'].'\\'.$sexe.'\\'.$categorie.'\\'.$couleur.'.png');

if(isset($_POST["submit"])){
  if ($check = getimagesize($_FILES["fileToUpload"]["tmp_name"])) {
    $uploadOk = 1;
  }
  else{
    $uploadOk =0;
  }
}



if (file_exists($nouveauFichier)) {
    echo "Ce fichier existe déjà.";
    $uploadOk = 0;
}
 ?>
