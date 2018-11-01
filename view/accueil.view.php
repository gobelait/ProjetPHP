<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Color 9 - Accueil</title>
    <link rel="stylesheet" href="../view/style/style.css">
  </head>
  <body>
    <header>
      <img src="../view/img/autre/logo.png" alt="Color 9 logo" class="logo_marque">
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
    <div class="bandeau">

    </div>
    <div class="mainbody">

      <div id="contener_sexe_accueil">
        <div class="item_homme">
          <a href="catalogue.ctrl.php?sexe=homme&categorie[]=all">
            <div class="conteneur_mannequin"><img src="../view/img/autre/homme.png" alt="Image Homme" title="Voir produits homme" class="mannequin"></div>
          </a>
        </div>
        <div class="item_femme">
          <a href="catalogue.ctrl.php?sexe=femme&categorie[]=all">
            <div class="conteneur_mannequin"><img src="../view/img/autre/femme.png" alt="Image Femme" title="Voir produits femme" class="mannequin"></div>
          </a>
        </div>
      </div>

    </div>
    <footer>
    </footer>
  </body>
</html>
