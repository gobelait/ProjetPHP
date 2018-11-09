
<?php
class Produit {
  public $path;
  public $id;
  public $sexe;
  public $nom;
  public $codetype;
  public $prix;
  public $description;
  public $couleurs;

  function __construct() {
    $couleurTemp = explode(";", $this->couleurs);
    $this->couleurs = array();
    foreach ($couleurTemp as $key => $value) {
      $couleurTemp = explode(" = ", $value);
      $this->couleurs[$couleurTemp[0]] = $couleurTemp[1];
  }
}

  //renvoi le produit de la couleur mise en paramètre si c'est possible
  function getProduitCouleur($path, $couleur) {
    if(array_key_exists($couleur, $this->couleurs)) {
      $produit = clone $this;
      $produit->path = $path.$this->sexe."/".$this->codetype."/".$this->id."_".$couleur.".png";
      $produit->couleur = $couleur;
      $produit->codecolor = $this->couleurs[$couleur];
      return $produit;
    } else
      throw "couleur inexistante";
  }

  //renvoi un tableau de produit coloré
  function getToutesLesCouleurs($path) : array {
    $produits = array();
    $i = 0;
    foreach ($this->couleurs as $couleur => $codecolor) {
      $produits[$i] = clone $this;
      $produits[$i]->path = $path.$this->sexe."/".$this->codetype."/".$this->id."_".$couleur.".png";
      $produits[$i]->couleur = $couleur;
      $produits[$i]->codecolor = $codecolor;
      $i++;
    }
    return $produits;
  }
}
 ?>
