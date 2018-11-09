<?php
require_once('../model/Produit.class.php');
require_once('../model/ProduitDAO.class.php');

// Récupération des données de configuration
$config = parse_ini_file('../config/config.ini');
<<<<<<< HEAD
$magasin = new ProduitDAO($config['dataPathLocalJerome']);  // à changer !
$categorieExistantes =$magasin.getCategories();
=======
$magasin = new ProduitDAO($config['dataPath']);  // à changer !
>>>>>>> 52ee5380767c35a5be96d4e687077539d081d439

// Mise en place du témoin de validation
$uploadOk = 1;

// Récupération des données envoyé par l'utilisateur
if (isset($_POST['sexe'])) {
  $sexe = strtolower($_POST['sexe']);
  if ($sexe == "homme"){
    $sexeOppose = "femme";
  }
  elseif ($sexe == "femme"){
    $sexeOppose = "homme";
  }
}

if (isset($_POST['couleur'])) {
  $couleur = $_POST['couleur'];
}

if (isset($_POST['categorie'])) {
  $categorie = strtolower($_POST['categorie']);
  $categorie[0]=strtoupper($categorie[0]);  //On formate le nom des catégorie avec une majuscule sur la première lettre
}

if (isset($_POST['nom'])) {
  $nomProduit = $_POST['nom'];
}

if (isset($_POST['prix'])) {
  $prix = $_POST['prix'];
}

if (isset($_POST['description'])) {
  $description = $_POST['description'];
}

// Traitement sur la catégorie du nouveau produit
$categorieExistantes =$magasin->getCategories($sexe); //On récupère toutes les catégories éxistantes
print_r($categorieExistantes);
if (!in_array($categorie,$categorieExistantes,true)){ //Si elle n'éxiste pas ...
    $codeCategorie = 1+($magasin->nombreDeCategories())[0][0];
    mkdir(strtolower($config['upload_dir'].$sexe.'/'.$codeCategorie));// on crée son répertoire
}
else {  // Si elle existe ...
  $codeCategorie = array_search($categorie,$categorieExistantes);
  if (!is_dir(strtolower($config['upload_dir'].$sexe.'/'.$codeCategorie))) {  // et que son répertoire n'existe pas dans le sexe choisi
    mkdir(strtolower($config['upload_dir'].$sexe.'/'.$codeCategorie));// on crée son répertoire
    $magasin->updateSexeCategorie($categorie,'mixte');
  }
}


// Traitement sur le nouveau produit


//On prépare le lien vers le nouveau fichier
$nouveauFichier =  strtolower($config['upload_dir'].$sexe.'/'.$codeCategorie.'/'.$couleur.'.png');



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

try {



if ($uploadOk) {  // Si tout est OK
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $nouveauFichier)) { // On crée le fichier de l'image et si il n'y a pas de problème durant sa création ...
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " a été ajouté."; // On informe l'utilisateur
        if (!in_array($categorie,$categorieExistantes,true)){  // Si la catégorie de  l'objet n'existe pas déjà ...
          $magasin->insertCategorie($codeCategorie,$categorie,$sexe);
        }
        $magasin->insertProduit($indiceProduit,$sexe,$nomProduit,$codeCategorie,$prix,$description,$couleur); // et on ajoute le produit à la BD

    } else {    // Si il y a eu un problème lors de la création de l'image
        echo "Désolé, il y a eu une erreur lors de l'ajout de votre image.";
    }
  }
  else {
    echo "Votre image ne corréspond pas aux attentes.";
  }
} catch (\Exception $e) {
  echo "Désolé, il y a eu une erreur lors de l'ajout de votre image. :(";
}
 ?>
