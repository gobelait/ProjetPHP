<?php
require_once('../model/Produit.class.php');
require_once('../model/ProduitDAO.class.php');

// Récupération des données de configuration
$config = parse_ini_file('../config/config.ini');
$magasin = new ProduitDAO($config['dataPath']);

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
$categorieExistantes =$magasin->getCategoriesSexe($sexe); //On récupère toutes les catégories éxistantes du sexe
$categorieExistantesOppose = $magasin->getCategoriesSexe($sexeOppose); //On récupère toutes les catégories éxistantes du sexeOppose
print_r($categorieExistantes);
print("<br>");
print_r($categorieExistantesOppose);
if (!( in_array($categorie,$categorieExistantes,true) || in_array($categorie,$categorieExistantesOppose,true))){ //Si elle n'éxiste pas ...
    print("NOUVELLE CATEGORIE");
    $codeCategorie = 1+($magasin->nombreDeCategories())[0][0];
    mkdir(strtolower($config['imgPath'].$sexe.'/'.$codeCategorie));// on crée son répertoire
}
else {  // Si elle existe ...
  print("CATEGORIE EXISTANTE  ");
  if (in_array($categorie,$categorieExistantes,true)) {
    print("CATEGORIE EXISTE DANS SEXE");
    $codeCategorie = array_search($categorie,$categorieExistantes);
  }
  elseif (in_array($categorie,$categorieExistantesOppose,true)) {
    print("CATEGORIE EXISTE DANS OPPOSE");
    $codeCategorie = array_search($categorie,$categorieExistantesOppose);
    if (!is_dir(strtolower($config['imgPath'].$sexe.'/'.$codeCategorie))) {  // et que son répertoire n'existe pas dans le sexe choisi
      mkdir(strtolower($config['imgPath'].$sexe.'/'.$codeCategorie));// on crée son répertoire
      $magasin->updateSexeCategorie($categorie,'mixte');
    }
  }


}


// Traitement sur le nouveau produit


//On prépare le lien vers le nouveau fichier
$nouveauFichier =  strtolower($config['imgPath'].$sexe.'/'.$codeCategorie.'/'/*.$indiceProduit.'_'*/.$couleur.'.png');



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
        if (!(in_array($categorie,$categorieExistantes,true))){  // Si la catégorie de  l'objet n'existe pas déjà ...
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
