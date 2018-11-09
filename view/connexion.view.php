<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Color 9 - Accueil</title>
    <link rel="stylesheet" href="../view/style/style.css">
  </head>
  <body>
    <header>
      <div class="logo_marque"><a href="accueil.ctrl.php"><img src="../view/img/autre/logo.png" alt="Color 9 logo"></a></div>
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
      <h1>Connexion administrateur:</h1>
      <span class="erreur">
        <?php
          if(isset($erreur))
            echo $erreur;
         ?>
      </span>
      <fieldset>
        <form class="controller/connexion.ctrl.php" method="post">
          <p>Entrez votre identifiant :</p>
          <input type="text" name="id" placeholder="identifiant" value="<?php if(isset($identifiant)) echo $identifiant ?>" required> <br>
          <p>Entrez votre mot de passe :</p>
          <input type="password" name="mdp" placeholder="mot de passe" required><br> <br>
          <input id="BoutonValider" type="submit" value="Connexion" name="action">
        </form>
      </fieldset>
    </div>
    <footer>
    </footer>
  </body>
</html>
