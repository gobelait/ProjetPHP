<?php
require_once('../model/ProduitDAO.class.php');

// Récupération des données de configuration
$config = parse_ini_file('../config/config.ini');
$magasin = new ProduitDAO($config['dataPath']);  // à changer !
$categorieExistantes =$magasin.getCategories();


$sexe = $_POST['sexe'];
$categorie = $_POST['categorie'];

//On regarde si la catégorie de l'objet éxiste déjà
if (!in_array($categorie,$categorieExistantes,true)){ //Si elle n'éxiste pas
    $indiceCategorie = $magasin.db.query("SELECT max(id) FROM  categorie")+1;
    $magasin.db.query("INSERT INTO categorie value ($nbCategories,$categorie,$sexe) "); //On la crée
    mkdir(strtolower($config['upload_dir'].$sexe.'/'.$nbCategorie)));//On crée sont répertoir
}

$couleur = $_POST['couleur'];
$taille = $_POST['tailles'];
$nouveauFichier =  strtolower($config['upload_dir'].$sexe.'/'.array_search($categorie,categorieExistantes,true).'/'.$couleur.'.png');

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
