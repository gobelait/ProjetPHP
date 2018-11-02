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
          <a href="catalogue.ctrl.php?sexe=homme&categorie[]=all"><li>Homme</li></a>
          <a href="catalogue.ctrl.php?sexe=femme&categorie[]=all"><li>Femme</li></a>
          <a href="catalogue.ctrl.php?sexe=mixte&categorie[]=all"><li>Tous les produits</li></a>
        </ul>
      </nav>
    </header>
    <div class="form_filtre">
      <form method="get" action="catalogue.ctrl.php">
      <?php if($sexe == "mixte") : ?>
      <label class="titre">Sexe</label>
      <br>
      <div class="inputGroup">
        <input id="radio1" name="sexe" type="radio" value="homme">
        <label for="radio1">Homme</label>
      </div>
      <div class="inputGroup">
        <input id="radio2" name="sexe" type="radio" value="femme">
        <label for="radio2">Femme</label>
      </div>
      <div class="inputGroup">
        <input id="radio3" name="sexe" type="radio" value="mixte">
        <label for="radio3">Mixte</label>
      </div><br><br>
      <?php endif; ?>
      <label class="titre">Catégories</label><br><br>
      <?php
        $i = 0;
        foreach ($produitsCategorise["categories"] as $categorie) {
          if($sexe == "mixte" || $categorie->sexe == "mixte" || $sexe == $categorie->sexe) {
            echo '<div class="inputGroup"><input type="checkbox" name="categorie[]" id="choix_categorie-'.$i.'" value="'.$categorie->code.'"><label for="choix_categorie-'.$i.'">'.$categorie->nom.'</label></div>';
          }
          $i++;
        }
       ?>
       <br>
      <button>Filtrer</button>
      </form>
    </div>

      <?php
      foreach ($produitsCategorise["categories"] as $categorie) { // parcours toutes les catégories
        if(in_array($categorie->code, $filtre) || in_array("all", $filtre)) {
          if($sexe == "mixte" || $categorie->sexe == "mixte" || $sexe == $categorie->sexe) { // si la catégorie est mixte ou correspond au critère
            echo '<h2 class="nom_categorie">'.$categorie->nom.'</h2><div class="categorie">';
            foreach ($produitsCategorise[$categorie->code] as $produit) { // parcours tous les produits
              if($sexe == "mixte" || $produit->sexe == $sexe) {
                echo '<div class="produit"><a href="produit.ctrl.php?produit='.$produit->id.'"><div class="conteneur_mannequin"><img src="'.$produit->path.'" alt="Image '.$produit->nom.' '.$produit->couleur.'" title="'.$produit->nom.'" class="mannequin"></div></a><a href="produit.ctrl.php?produit='.$produit->id.'"><h3 class="nom_produit">'.$produit->nom.'</h3></a><span class="prix">'.$produit->prix.' €</span></div>';
              }
            }
            echo '</div>';
          }
        }
      } ?>

      <input type="hidden" name="nom" value="<?= $sexe ?>"/>

    </div>
    <footer>
    </footer>
  </body>
</html>
