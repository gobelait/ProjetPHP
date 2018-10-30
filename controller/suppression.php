<?php
// Récupération des données de configuration

$config = parse_ini_file('../config/config.ini');

$sexe = $_POST['sexe'];
$categorie = $_POST['categorie'];
$couleur = $_POST['couleur'];
$fichierCible =  strtolower($config['upload_dir'].$sexe.'/'.$categorie.'/'.$couleur.'.png');

if (file_exists($fichierCible)){
  unlike($fichierCible);
  echo "Le fichier a été supprimé.";
}

 ?>
