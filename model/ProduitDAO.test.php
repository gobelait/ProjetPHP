<?php

require_once('Produit.classe.php');
require_once('ProduitDAO.class.php');

// Récupération des données de configuration
$config = parse_ini_file('../config/config.ini');

// Creation de l'instace DAO
$magasin = new ProduitDAO($config['dataPath']);

$m = $magasin->getAll();
var_dump($m);

// a enlever

A TESTER TRES TRES VITE ALEEEEED

$m[0].getProduitsCouleur("test/test");

?>
