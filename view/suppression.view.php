<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/style_suppression.css">
    <title>Color 9</title>
  </head>
  <body>
    <header>
    <img src="../view/img/autre/logo.png" alt="Color 9 logo" class="logo_marque">
    </header>

        <h1>Suppression d'un produit :</h1>

        <form action="../controller/suppression.ctrl.php" method="post" enctype="multipart/form-data">
          <p>
            Entrez sa catégorie :
            <input type="text" name="categorie" value="chemise" autofocus required> <br>
            <!-- Entrez sa couleur :
            <input type="text" name="couleur" value="noir" required> <br> -->
            Entrez le sexe du produit :
            <input type="text" name="sexe" value="femme" required>
            <input id="BoutonValider" type="submit" value="Supprimer" name="action">
          </p>
        </form>
  </body>
</html>
