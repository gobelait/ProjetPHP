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

      <div class="contener">
        <div class="item_homme">
          <a href="catalogue.ctrl.php?sexe=homme&categorie=null">
            <img src="../view/img/autre/homme.png" alt="Image Homme" title="Voir produits homme">
          </a>
        </div>
        <div class="item_femme">
          <a href="catalogue.ctrl.php?sexe=femme&categorie=null">
            <img src="../view/img/autre/femme.png" alt="Image Femme" title="Voir produits femme">
          </a>
        </div>
      </div>

    </div>
    <footer>
      <a href="#">Connexion admin</a>
    </footer>
  </body>
</html>
