<?php

class ProduitDAO
{
  private $db;
  function __construct($path) {
    try {
      $this->db = new PDO('sqlite:'.$path.'/produit.db');
    } catch (Exception $e) {
      echo "Erreur lors de l'ouverture de la base de données";
    }
  }

  // renvoie tous les produits de la catégorie de la base de données
  function getCategory(int $category) : array {
    $produits =  $this->db->query("SELECT * FROM produit WHERE codetype = $category")->fetchAll(PDO::FETCH_CLASS, "Produit");
    // constructeur appelé après le fectchclass
    return $produits;
  }

  // renvoie tous les produits de la catégorie et du sexe de la base de données
  function getCategorySexe(int $category, string $sexe) : array {
    if($sexe == "homme" || $sexe == "femme") { // si le sexe est bien annoncé
      $produit = $this->db->query("SELECT * FROM produit WHERE codetype = $category and sexe = $sexe")->fetchAll(PDO::FETCH_CLASS, "Produit");
      return $produit;
    } else {
      echo "Erreur, sexe == femme ou homme";
      return 0;
    }
  }

  // renvoie tous les produits de la base de données
  function getAll() : array {
    $produits =  $this->db->query("SELECT * FROM produit")->fetchAll(PDO::FETCH_CLASS, "Produit");
    // constructeur appelé après le fectchclass
    return $produits;
  }
}

?>
