
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
    $this->couleurs = explode(";", $this->couleurs);
    foreach ($this->couleurs as $key => $value) {
      $this->couleurs[$key] = explode(" = ", $value);
    }
  }

  //renvoi le produit par défaut
  function getProduitExpo($path) {
    $this->path = $path.$this->sexe."/".$category[$this->codetype]."/".$couleur[0].".png";
    $i = 0;
    foreach ($this->couleurs as $couleur) { //$ couleur = array(nomCouleur -> codecouleur)
      $produits[$i] = clone $this;
      $produits[$i]->path = $path.$this->sexe."/".$this->codetype."/noir.png";
      $produits[$i]->couleur = $couleur[0];
      $produits[$i]->codecolor = $couleur[1];
      $i+=1;
    }
    return $produits;
  }

  //renvoi un tableau de produit coloré
  function getProduitParCouleur($path) : array {
    $produits = array();
    $i = 0;
    foreach ($this->couleurs as $couleur) { //$ couleur = array(nomCouleur -> codecouleur)
      $produits[$i] = clone $this;
      $produits[$i]->path = $path.$this->sexe."/".$this->codetype."/".$couleur[0].".png";
      $produits[$i]->couleur = $couleur[0];
      $produits[$i]->codecolor = $couleur[1];
      $i+=1;
    }
    return $produits;
  }
}
 ?>
