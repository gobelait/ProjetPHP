<?php
require_once('../model/Produit.class.php');
require_once('../model/ProduitDAO.class.php');

// Récupération des données de configuration
$config = parse_ini_file('../config/config.ini');
$magasin = new ProduitDAO($config['dataPath']);  // à changer !

// Mise en place des témoins de validation
$supressionOk = 1;
$categorieMixte = 0;

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
  $categorieExistantes =$magasin->getCategories($sexe); //On récupère toutes les catégories éxistantes
  if (in_array($categorie,$categorieExistantes,true)){
    $codeCategorie = array_search($categorie,$categorieExistantes);
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


$magasin->deleteCategorie($categorie);
$dossierCible =  strtolower($config['upload_dir'].$sexe.'/'.$codeCategorie);
$dossierCibleOppose =  strtolower($config['upload_dir'].$sexeOppose.'/'.$codeCategorie);
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
    echo "Désolé, il y a eu une erreur lors de la supréssion du produit.";
  }
}
else {
  echo "Votre requête ne corréspond pas aux attentes.";
}

 ?>
