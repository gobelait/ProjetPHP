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

  //renvoie le nombre de catégories
  function nombreDeCategories(){
    return $this->db->query("SELECT max(code) FROM  categorie")->fetchAll();
  }

  //permet de mettre à jour une catégorie
  function updateSexeCategorie($nomCategorie,$sexeCible){
    if ($sexeCible == "femme" || $sexeCible == "homme" || $sexeCible == "mixte") {
      $stmt = $this->db->prepare("UPDATE categorie SET sexe = :sexe WHERE nom = :nom");
      $stmt->bindValue(':nom',$nomCategorie);
      $stmt->bindValue(':sexe',$sexeCible);
      $stmt->execute();
    }
    else {
      print("et nonnn");
    }
  }

  // permet de supprimer une catégories
  function deleteCategorie($nomCategorie){
    $stmt = $this->db->prepare("DELETE FROM categorie WHERE nom=:nom");
    $stmt->bindValue(':nom',$nomCategorie);
    $stmt->execute();
  }

  // permet d'ajouter une catégorie
  function insertCategorie($code,$nomCategorie,$sexe) {
    $sql = 'INSERT INTO categorie(code,nom,sexe) VALUES(:code,:nomCategorie,:sexe)';
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':code',$code);
    $stmt->bindValue(':nomCategorie',$nomCategorie);
    $stmt->bindValue(':sexe',$sexe);
    $stmt->execute();

    return $this->db->lastInsertId();
  }

  // permet d'ajouter un produit
  function insertProduit($id,$sexe,$nom,$codetype,$prix,$description,$couleurs) {
    $sql = 'INSERT INTO produit(id,sexe,nom,codetype,prix,description,couleurs) VALUES(:id,:sexe,:nom,:codetype,:prix,:description,:couleurs)';
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->bindValue(':sexe',$sexe);
    $stmt->bindValue(':nom',$nom);
    $stmt->bindValue(':codetype',$codetype);
    $stmt->bindValue(':prix',$prix);
    $stmt->bindValue(':description',$description);
    $stmt->bindValue(':couleurs',$couleurs);
    $stmt->execute();

    return $this->db->lastInsertId();
  }

  // permet de supprimer un produit
  function deleteProduit($codetype,$sexe){

    // $sql = 'UPDATE INTO produit SET couleurs = :couleurs WHERE sexe = :sexe AND codetype = :codetype';
    // $stmt = $this->db->prepare($sql);
    // $stmt->bindValue(':couleurs',$couleurs);
    // $stmt->bindValue(':codetype',$codetype);
    // $stmt->bindValue(':sexe',$sexe);
    // $stmt->execute();

    $sql = 'DELETE FROM produit WHERE sexe=:sexe AND codetype = :codetype';
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':sexe',$sexe);
    $stmt->bindValue(':codetype',$codetype);
    $stmt->execute();

  }

  // renvoie le sexe de la categorie en fonction du nom
  function getCategorieSexe($nomCategorie){
    $a = $this->db->query("SELECT sexe FROM categorie WHERE nom = $nomCategorie");
  }

  function getCategories() : array{
    $categorie = $this->db->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_CLASS, "Categorie");
    return $categorie;
  }

  // renvoie la liste de toutes les catégories de produit en fonction du sexe
  function getCategoriesSexe($sexe): array{
    if($sexe == "femme"){
      $a= $this->db->query("SELECT nom, code FROM categorie WHERE sexe='femme' or sexe='mixte'");
      foreach ($a as $row) {
          $T[$row['code']] = $row['nom'];
      }
      return $T;
    }
    elseif($sexe == "homme"){
      $a = $this->db->query("SELECT nom, code FROM categorie WHERE sexe='homme' or sexe='mixte'");
      foreach ($a as $row) {
          $T[$row['code']] = $row['nom'];
      }
      return $T;
    }
    else {
      echo "ERREUR - Veuillez entrer un sexe correcte. (homme ou femme)";
      return array();
    }

  }

  // renvoie tous les admin du site
  function getAdmins() : array {
    return $this->db->query("SELECT * FROM admin")->fetchAll(PDO::FETCH_CLASS, "Admin");
  }

  // get produit catégories
  function getProduitId(int $id) : array {
    return $this->db->query("SELECT * FROM produit WHERE id = $id")->fetchAll(PDO::FETCH_CLASS, "Produit");
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
        $produitsCouleur = array_merge($produitsCouleur, $produit->getToutesLesCouleurs($path));
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
