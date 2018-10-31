<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Color 9 - Catalogue</title>
    <link rel="stylesheet" href="../view/style/style.css">
  </head>
  <body>
    <header>
      <img src="../view/img/autre/logo.png" alt="Color 9 logo">
      <div class="connexion">
        <img src="../view/img/logos/connexion.png" alt="">
        <span>Connexion</span>
      </div>
      <nav>
        <ul>
          <a href="catalogue.ctrl.php?sexe=homme&categorie=null"><li>Homme</li></a>
          <a href="catalogue.ctrl.php?sexe=femme&categorie=null"><li>Femme</li></a>
          <a href="catalogue.ctrl.php?sexe=null&categorie=null"><li>Tous les produits</li></a>
        </ul>
      </nav>
    </header>
    <div class="bandeau">

    </div>
    <div class="mainbody">

      <?php
      foreach ($produitsCategorise["categories"] as $categorie) { // parcours toutes les catégories
        echo '<div class="categorie"><h2 class="nom_categorie">'.$categorie->nom.'</h2>';
        foreach ($produitsCategorise[$categorie->code] as $produit) { // parcours tous les produits
          if($sexe == "null" || $produit->sexe == $sexe) {
            echo '<div class="produit"><a href="produit.ctrl.php?produit='.$produit->id.'"><img src="'.$produit->path.'" alt="Image '.$produit->nom.' '.$produit->couleur.'" title="'.$produit->nom.'"></a><h3 class="nom_produit">'.$produit->nom.'</h3><span class="prix">'.$produit->prix.' €</span><span class="details">détails</span></div>';
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
