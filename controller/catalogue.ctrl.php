<?php

require_once('../model/Produit.class.php');
require_once('../model/Categorie.class.php');
require_once('../model/ProduitDAO.class.php');

// Création de l'instance DAO

$config = parse_ini_file('../config/config.ini');

$magasin = new ProduitDAO($config['dataPathLocalBarth']);

// Récupération des produits

$produitsCategorise = $magasin->getProduitsParCategories($config['imgPath']);

if (isset($_GET['sexe'])) {
  $sexe = $_GET['sexe'];
  if($sexe != 'homme' && $sexe != 'femme') {
    $sexe = 'mixte';
  }
} else {
  $sexe = 'mixte';
}

$filtre = array();

if(!empty($_GET['categorie'])) {
  foreach($_GET['categorie'] as $value) {
    $filtre[] = $value;
  }
} else { // si aucun filtre choisi on affiche tout
  $filtre[] = "all";
}
include('../view/catalogue.view.php');

 ?>
