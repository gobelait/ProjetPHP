<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/style_ajout.css">
    <title></title>

  </head>
  <body>

    <img id="Logo" src="img/Color9.png">

    <h1>Ajout d'un nouveau produit :</h1>

    <form action="../controller/ajout.php" method="post" enctype="multipart/form-data">
      <p>
        Entrez sa catégorie :
        <input type="text" name="categorie" value="chemise" autofocus required> <br>
        Entrez sa couleur :
        <input type="text" name="couleur" value="noir" required> <br>
        Selectionnez une image :
        <input type="file" name="fileToUpload" id="fileToUpload" required><br>
        Entrez le sexe du model de l'image :
        <input type="text" name="sexe" value="femme" required>
        <input id="BoutonValider" type="submit" value="Upload Image" name="action">
      </p>
    </form>
  </body>
</html>