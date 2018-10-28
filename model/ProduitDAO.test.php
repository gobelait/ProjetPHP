<?php

require_once('Produit.classe.php');
require_once('ProduitDAO.class.php');

// Récupération des données de configuration
$config = parse_ini_file('../config/config.ini');

// Création de l'instance DAO
$magasin = new ProduitDAO($config['dataPath']);

$m = $magasin->getAll();
var_dump($m);

// test getProduitParCouleur
//echo '<pre>' , var_dump($m[0]->getProduitParCouleur("test/test/")[0]) , '</pre>';

?>
