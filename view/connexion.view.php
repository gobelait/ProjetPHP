<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
  </head>
  <body>
    <h1>Connexion administrateur:</h1>
    <fieldset>
      <form class="controller/connexion.ctrl.php" method="post">
        <p>Entrez votre identifiant:</p>
        <input type="text" name="id" value="identifiant"> <br>
        <p>Entrez votre mot de passe:</p>
        <input type="text" name="mdp" value=""><br> <br>
        <input id="BoutonValider" type="submit" value="Connexion" name="action">
      </form>
    </fieldset>
  </body>
</html>
