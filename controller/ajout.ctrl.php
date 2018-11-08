<?php
require_once('../model/Produit.class.php');
require_once('../model/Categorie.class.php');
require_once('../model/ProduitDAO.class.php');

// Récupération des données de configuration
$config = parse_ini_file('../config/config.ini');
$magasin = new ProduitDAO($config['dataPath']);  // à changer !


// Récupération des données envoyé par l'utilisateur
if (isset($_POST['sexe'])) {
  $sexe = $_POST['sexe'];
}
if (isset($_POST['couleur'])) {
  $couleur = $_POST['couleur'];
}
if (isset($_POST['categorie'])) {
  $categorie = $_POST['categorie'];
}

$j = $magasin->test();

// Traitement sur la catégorie du nouveau produit
$categorieExistantes =$magasin->getCategories($sexe); //On récupère toutes les catégories éxistantes
if (!in_array($categorie,$categorieExistantes,true)){ //Si elle n'éxiste pas
    print("<br> ELLE NEXISTE PAS <br>");
    $indiceCategorie = ($magasin->nombreDeCategories())[0][0];
    $magasin->insertCategorie($indiceCategorie,$categorie,$sexe); //On la crée
    print("mkdir va etre   ".strtolower($config['upload_dir'].$sexe.'/'.$indiceCategorie)."<br>");
    mkdir(strtolower($config['upload_dir'].$sexe.'/'.$indiceCategorie));//On crée son répertoir
}

//On prépare le lien vers le nouveau fichier
$nouveauFichier =  strtolower($config['upload_dir'].$sexe.'/'.(array_search($categorie,$categorieExistantes,true)+1).'/'.$couleur.'.png');
print("nouveau fichier va être    ".$nouveauFichier."      <br>");
$uploadOk = 1;


if(isset($_POST["submit"])){
  if (!getimagesize($_FILES["fileToUpload"]["tmp_name"])) {
    $uploadOk = 0;
  }
}

//On regarde si le fichier en question éxiste déjà
if (file_exists($nouveauFichier)) {
    echo "Ce fichier existe déjà.<br>";
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
