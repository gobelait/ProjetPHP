<?php
// Récupération des données de configuration
$config = parse_ini_file('../config/config.ini');

$sexe = $_POST['sexe'];
$categorie = $_POST['categorie'];
$couleur = $_POST['couleur'];
$repertoireCible =  strtolower($config['upload_dir'].$sexe.'/'.$categorie);
$nouveauFichier =  strtolower($config['upload_dir'].$sexe.'/'.$categorie.'/'.$couleur.'.png');

$uploadOk = 1;


if(isset($_POST["submit"])){
  if (!getimagesize($_FILES["fileToUpload"]["tmp_name"])) {
    $uploadOk = 0;
  }
}

//On regarde si le fichier en question éxiste déjà
if (file_exists($nouveauFichier)) {
    echo "Ce fichier existe déjà.";
    $uploadOk = 0;
}

//On regarde si le répertoir de la catégorie existe déjà
if (!is_dir($repertoireCible) && $uploadOk){
  mkdir($repertoireCible); //Si il n'éxiste pas, on le crée
}

if ($uploadOk) {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $nouveauFichier)) {
      echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " a été ajouté.";
  } else {
      echo "Désolé, il y a eu une erreur lors de l'ajout de votre image.";
  }
}
else {
  echo "Votre image ne corréspond pas aux attentes.";
}

 ?>
