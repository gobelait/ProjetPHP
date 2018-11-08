<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Color 9 - Accueil</title>
    <link rel="stylesheet" href="../view/style/style.css">
  </head>
  <body>
    <header>
      <div class="logo_marque"><img src="../view/img/autre/logo.png" alt="Color 9 logo"></div>
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
    <div class="mainbody">
      <div class="expoproduit">
        <div>
          <img src="<?= $produit->path ?>" alt="Image <?= $produit->path ?> <?= $produit->couleur ?>" title="<?= $produit->path ?>" class="mannequin">
        </div>
        <div class="produit expo">
          <h3 class="nom_produit"><?= $produit->nom ?></h3>
          <span class="prix"><?= $produit->prix ?> €</span>
          <span class="description"><?= $produit->description ?></span>
          <span class="taille">*Tous nos vêtements son fait sur mesures</span>
        </div>
      </div>
    </div>
    <footer>
    </footer>
  </body>
</html>
