<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/style_ajout.css">
    <title></title>

  </head>
  <body>
    <header>
    <img src="../view/img/autre/logo.png" alt="Color 9 logo" class="logo_marque">
    </header>


    <h1>Ajout d'un nouveau produit :</h1>

    <form action="../controller/ajout.ctrl.php" method="post" enctype="multipart/form-data">
      <p>
        Entrez sa catégorie :
        <input type="text" name="categorie" value="chemise" autofocus required> <br>
        Entrez sa couleur :
        <input type="text" name="couleur" value="noir" required> <br>
        Entrez le sexe du model de l'image :
        <input type="text" name="sexe" value="femme" required> <br>
        Entrez le prix de ce produit
        <input type="int" name="prix" value="10" required><br>
        Entrez la déscription du produit
        <input id="descriptionBox" type="text" name="description" value="Un produit abordable." required>
        Selectionnez une image :
        <input type="file" name="fileToUpload" id="fileToUpload" required><br>
        <input id="BoutonValider" type="submit" value="Upload Image" name="action">
      </p>
    </form>
  </body>
</html>
