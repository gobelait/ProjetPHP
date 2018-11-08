<?php

require_once('../model/Produit.class.php');
require_once('../model/Categorie.class.php');
require_once('../model/ProduitDAO.class.php');

// Création de l'instance DAO

$config = parse_ini_file('../config/config.ini');

$magasin = new ProduitDAO($config['dataPath']);



if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  $id = 1;
}
if (isset($_GET['couleur'])) {
  $couleur = $_GET['couleur'];
  try {
    // Récupération du produit
    $produit = $magasin->getProduitId($id);
    if($produit[0]) {
      $produit = $produit[0]->getProduitCouleur($config['imgPath'], $couleur);
    }
    //affichage de la vue
    include('../view/produit.view.php');
  } catch (Exception $e) {
    echo "Couleur inexistante";
  }
} else {
  echo "erreur ! couleur invalide";
}

 ?>
