<?php


require_once('../model/Produit.classe.php');
require_once('../model/ProduitDAO.class.php');

// Récupération des données de configuration
$config = parse_ini_file('../config/config.ini');

// Creation de l'instace DAO
$magasin = new ProduitDAO($config['dataPathLocalAntoine']); // changer le path (ici pour chez moi)

$m = $magasin->getAll();

$tousLesProduit = array();
foreach ($m as $unTypeProduit) {
  $tousLesProduit[] = $unTypeProduit->getProduitParCouleur($config['imgPath']);
}
foreach ($tousLesProduit as $unProduit) {
  foreach ($unProduit as $unProduitColore) {
    echo ' <img src="'.$unProduitColore->path.'"  title = "'.$unProduitColore->nom.' ('.$unProduitColore->couleur.')"><br><p style="color:'.$unProduitColore->codecolor.'">'.$unProduitColore->nom.'</p>';
  }
}


?>
