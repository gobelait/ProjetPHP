<?php

require_once('../model/Produit.class.php');
require_once('../model/Categorie.class.php');
require_once('../model/ProduitDAO.class.php');

// Création de l'instance DAO

$config = parse_ini_file('../config/config.ini');

$magasin = new ProduitDAO($config['dataPathLocalAntoine']);

// Récupération des produits

$produitsCategorise = $magasin->getProduitsParCategories($config['imgPath']);

if (isset($_GET['sexe'])) {
  $sexe = $_GET['sexe'];
  if($sexe != 'homme' && $sexe != 'femme') {
    $sexe = 'null';
  }
} else {
  $sexe = 'null';
}
include('../view/catalogue.view.php');

 ?>
