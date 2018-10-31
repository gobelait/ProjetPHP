<?php

class ProduitDAO
{
  private $db;
  private $dbCategorie;
  function __construct($path) {
    try {
      $this->db = new PDO('sqlite:'.$path.'/database.db');
    } catch (Exception $e) {
      echo "Erreur lors de l'ouverture de la base de données";
    }
  }

  //renvoie la liste de toutes les catégories de produit
  function getCategories() : array{
    $categorie = $this->db->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_CLASS, "Categorie");
    return $categorie;
  }

  // renvoie tous les produits de la categorie passé en paramètre
  function getProduitParCategorie(int $category) : array {
    return $this->db->query("SELECT * FROM produit WHERE codetype = $category")->fetchAll(PDO::FETCH_CLASS, "Produit");
  }

  // renvoie tous les produits du sexe passé en paramètre
  function getProduitParSexe(string $sexe) : array {
    if($sexe == "homme" || $sexe == "femme") { // si le sexe est bien annoncé
      $produit = $this->db->query("SELECT * FROM produit WHERE codetype = $category and sexe = $sexe")->fetchAll(PDO::FETCH_CLASS, "Produit");
      return $produit;
    } else {
      echo "Erreur, sexe == femme ou homme";
      return 0;
    }
  }

  // renvoie tous les produits de la base de données
  function getTousLesProduits() : array {
    return $this->db->query("SELECT * FROM produit")->fetchAll(PDO::FETCH_CLASS, "Produit");
  }
}

?>
