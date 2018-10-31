
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
    $this->tailles = explode(",", $this->tailles);
    $couleurTemp = explode(";", $this->couleurs);
    $this->couleurs = array();
    foreach ($couleurTemp as $key => $value) {
      $couleurTemp = explode(" = ", $value);
      $this->couleurs[$couleurTemp[0]] = $couleurTemp[1];
    }
  }

  //renvoi le produit par défaut
  function getProduitExpo($path) {
    $this->path = $path.$this->sexe."/".$this->codetype."/noir.png";
    $i = 0;
    foreach ($this->couleurs as $couleur) { //$ couleur = array(nomCouleur -> codecouleur)
      $produits[$i] = clone $this;
      $produits[$i]->path = $path.$this->sexe."/".$this->codetype."/noir.png";
      $produits[$i]->couleur = "noir";
      $produits[$i]->codecolor = "#000000";
      $i+=1;
    }
    return $produits;
  }

  //renvoi un tableau de produit coloré
  function getProduitParCouleur($path) : array {
    $produits = array();
    $i = 0;
    foreach ($this->couleurs as $couleur => $codecolor) {
      $produits[$i] = clone $this;
      $produits[$i]->path = $path.$this->sexe."/".$this->codetype."/".$couleur.".png";
      $produits[$i]->couleur = $couleur;
      $produits[$i]->codecolor = $codecolor;
      $i++;
    }
    return $produits;
  }
}
 ?>
