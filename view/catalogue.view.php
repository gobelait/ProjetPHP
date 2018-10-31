<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Color 9 - Catalogue</title>
    <link rel="stylesheet" href="../view/style/style.css">
  </head>
  <body>
    <header>
      <a href="accueil.ctrl.php"><img src="../view/img/autre/logo.png" alt="Color 9 logo" class="logo_marque"></a>
      <a href="connexion.ctrl.php"><div class="connexion">
        <img src="../view/img/logos/connexion.png">
        <span>Connexion</span>
      </div></a>
      <nav>
        <ul>
          <a href="catalogue.ctrl.php?sexe=homme&categorie=null"><li>Homme</li></a>
          <a href="catalogue.ctrl.php?sexe=femme&categorie=null"><li>Femme</li></a>
          <a href="catalogue.ctrl.php?sexe=null&categorie=null"><li>Tous les produits</li></a>
        </ul>
      </nav>
    </header>
    <div class="mainbody">

      <nav class="tri_filtre">

      </nav>

      <?php
      foreach ($produitsCategorise["categories"] as $categorie) { // parcours toutes les catégories
        echo '<h2 class="nom_categorie">'.$categorie->nom.'</h2><div class="categorie">';
        foreach ($produitsCategorise[$categorie->code] as $produit) { // parcours tous les produits
          if($sexe == "null" || $produit->sexe == $sexe) {
            echo '<div class="produit"><a href="produit.ctrl.php?produit='.$produit->id.'"><div class="conteneur_mannequin"><img src="'.$produit->path.'" alt="Image '.$produit->nom.' '.$produit->couleur.'" title="'.$produit->nom.'" class="mannequin"></div></a><a href="produit.ctrl.php?produit='.$produit->id.'"><h3 class="nom_produit">'.$produit->nom.'</h3></a><span class="prix">'.$produit->prix.' €</span></div>';
          }
        }
        echo '</div>';
      } ?>

      <input type="hidden" name="nom" value="<?= $sexe ?>"/>

    </div>
    <footer>
    </footer>
  </body>
</html>
