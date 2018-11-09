<?php
require_once('../model/Produit.class.php');
require_once('../model/ProduitDAO.class.php');

// Récupération des données de configuration
$config = parse_ini_file('../config/config.ini');
$magasin = new ProduitDAO($config['dataPath']);

// Mise en place des témoins de validation
$supressionOk = 1;
$categorieMixte = 0;

//définition des différentes catégories supprimables

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

if (isset($_POST['categorie'])) {
  $categorie = strtolower($_POST['categorie']);
  $categorie[0]=strtoupper($categorie[0]);  //On formate le nom des catégorie avec une majuscule sur la première lettre
  $categorieExistantes =$magasin->getCategoriesSexe($sexe); //On récupère toutes les catégories éxistantes du sexe
  $categorieExistantesOppose = $magasin->getCategoriesSexe($sexeOppose); //On récupère toutes les catégories éxistantes du $sexeOppose
  if (in_array($categorie,$categorieExistantes,true)){
    $codeCategorie = array_search($categorie,$categorieExistantes);
  }
  elseif (in_array($categorie,$categorieExistantesOppose,true)) {
    $codeCategorie = array_search($categorie,$categorieExistantesOppose);
  }
  else {
    $codeCategorie = null;
    print("ERREUR - Cette catégorie n'existe pas.<br>");
    $supressionOk = false;
  }
}

// if (isset($_POST['couleur'])) {
//   $couleur = $_POST['couleur'];
// }

// $dossierCible = "../view/img/vetement/homme/10";
// $objects = scandir($dossierCible);
// foreach ($objects as $object) {
//   if ($object != "." && $object != "..") {
//     if (filetype($dossierCible."/".$object) == "dir") rmdir($dossierCible."/".$object); else unlink($dossierCible."/".$object);
//   }
// }
// rmdir($dossierCible);

if (in_array($categorie,$categorieExistantes,true) && !(in_array($categorie,$categorieExistantesOppose,true))) {
  print("dans categorie mais pas dans OPPOSE => suppr");
  $magasin->deleteCategorie($categorie);
}
elseif (in_array($categorie,$categorieExistantes,true) && in_array($categorie,$categorieExistantesOppose,true)) {
  print("dans categorie mais pas dans OPPOSE => suppr");
  $magasin->updateSexeCategorie($categorie,$sexeOppose);
}


$dossierCible =  strtolower($config['imgPath'].$sexe.'/'.$codeCategorie);
$dossierCibleOppose =  strtolower($config['imgPath'].$sexeOppose.'/'.$codeCategorie);
if (is_dir($dossierCibleOppose)) {
  print("mixte!");
  $categorieMixte = 1;
}
print("dossiercible va être : $dossierCible");
if (is_dir($dossierCible) && $supressionOk){
  $objects = scandir($dossierCible);
  foreach ($objects as $object) {
    if ($object != "." && $object != "..") {
      if (filetype($dossierCible."/".$object) == "dir") rmdir($dossierCible."/".$object); else unlink($dossierCible."/".$object);
    }
  }
  reset($objects);
  if (rmdir($dossierCible)){
    $magasin->deleteProduit($sexe,$codeCategorie);
    if ($categorieMixte) {
      $magasin->updateSexeCategorie($codeCategorie,$sexeOppose);
    }
    else {
      $magasin->deleteCategorie($categorie);
    }

    echo "Le fichier a été supprimé.";
  }
  else {
    echo "Désolé, il y a eu une erreur lors de la suppréssion du produit.";
  }
}
else {
  echo "Votre requête ne corréspond pas aux attentes.";
}

 ?>
