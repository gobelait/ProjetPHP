<?php

class Produit {
  public $path;
  public $id;
  public $sexe;
  public $nom;
  public $codetype;
  public $tailles;
  public $prix;
  public $description;
  public $couleurs;

  function __construct() {


    $this->tailles = explode(" = ", $this->tailles);
    $this->couleurs = explode(";", $this->couleurs);
    foreach ($this->couleurs as $key => $value) {
      $this->couleurs[$key] = explode(",", $value);
    }
  }
  
  function getProduitParCouleur($path) : array {
    $produits = array();
    $i = 0;
    foreach ($this->couleurs as $couleur) { //$ couleur = array(nomCouleur -> codecouleur)
      $produits[$i] = clone $this;
      $produits[$i]->path = $path.$this->sexe."/".$couleur[0].".png";
      $produits[$i]->couleur = $couleur[0];
      $produits[$i]->codecolor = $couleur[1];
      $i+=1;
    }

    return $produits;
  }
}

 ?>
