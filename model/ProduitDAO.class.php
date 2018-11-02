<?php

class ProduitDAO
{
  private $db;
  function __construct($path) {
    try {
      $this->db = new PDO('sqlite:'.$path.'/database.db');
    } catch (Exception $e) {
      echo "Erreur lors de l'ouverture de la base de données";
    }
  }

  // renvoie tous les admin du site
  function getAdmins() : array {
    return $this->db->query("SELECT * FROM admin")->fetchAll(PDO::FETCH_CLASS, "Admin");
  }

  //renvoie la liste de toutes les catégories de produit
  function getCategories() : array{
    $categorie = $this->db->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_CLASS, "Categorie");
    return $categorie;
  }

  // renvoie tous les produits de la categorie passé en paramètre
  function getProduitCategorie(int $category) : array {
    return $this->db->query("SELECT * FROM produit WHERE codetype = $category")->fetchAll(PDO::FETCH_CLASS, "Produit");
  }

  // renvoie tous les produits classé dans un tableau par catégorie avec les catégories stockées dedans pour garentir
  // la correspondance catégorie produits en cas de modification
  function getProduitsParCategories($path) : array {
    $categories = $this->getCategories();
    $produitsFinal = array();
    foreach ($categories as $categorie) {
      $produitsTemp = $this->getProduitCategorie($categorie->code);
      $produitsCouleur = array();
      foreach ($produitsTemp as $produit) {
        $produitsCouleur = array_merge($produitsCouleur, $produit->getProduitParCouleur($path));
      }
      $produitsFinal[$categorie->code] = $produitsCouleur;
    }
    $produitsFinal["categories"] = $categories;
    return $produitsFinal;
  }

  // renvoie tous les produits du sexe passé en paramètre
  function getProduitSexe(string $sexe) : array {
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
