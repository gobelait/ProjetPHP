<?php
require_once('../model/ProduitDAO.class.php');
require_once('../model/Admin.class.php');

$config = parse_ini_file('../config/config.ini');
$magasin = new ProduitDAO($config['dataPathLocalJerome']);
$admins = $magasin.getAdmins();

$identifiant = $_POST['id'];
$mdp = $_POST['mdp'];

$ad = array();

foreach($admins as $value) {
  $ad[] = $value;
  if ($identifiant = $ad[]->id) {
    header("view/choixAdmin.ctrl.php");

  }
  else {
    echo "identifiant ou mot de passe incorect";
  }
}




include('../view/connexion.view.php');

 ?>
