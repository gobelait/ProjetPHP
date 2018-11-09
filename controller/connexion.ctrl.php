<?php
require_once('../model/ProduitDAO.class.php');
require_once('../model/Admin.class.php');

$config = parse_ini_file('../config/config.ini');
$magasin = new ProduitDAO($config['dataPath']);
$admins = $magasin->getAdmins();
if(!isset($_POST['id']) && !isset($_POST['mdp'])) {
  include("../view/connexion.view.php");
}
else {
$identifiant = $_POST['id'];
$mdp = $_POST['mdp'];
$admin = new Admin();
$admin->id=$identifiant;
$admin->mdp=$mdp;
  if (in_array($admin, $admins)) {
    include("../view/choixAdmin.view.php");
  }
  else {
    $erreur = "identifiant ou mot de passe incorect";
    include("../view/connexion.view.php");
  }
}

 ?>
