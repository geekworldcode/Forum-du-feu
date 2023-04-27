<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Inscription - Forum des passionnes du feu</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body class="register">
    <header>
      <h1>Forum des passionnés du feu</h1>
      <div class="mon-compte">
        <a href="http://forumdufeu.yn.lu">Accueil</a>
     </div>
    </header>
    <main>
      <h2>Inscription</h2>
<?php 
error_reporting(E_ALL & ~E_NOTICE );
ini_set("error_reporting", E_ALL);
ini_set("display_errors","0"); // masque ou afficahe les  erreurs
?>
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $prenom = $_POST["prenom"];
          $email = $_POST["email"];
          $mdp = $_POST["mdp"];
          $mdp_confirmation = $_POST["mdp_confirmation"];

          // Vérification que les champs sont bien remplis et que les mots de passe sont identiques
          if (empty($prenom) || empty($email) || empty($mdp) || empty($mdp_confirmation) || $mdp != $mdp_confirmation) {
            echo "<p>Erreur : veuillez remplir tous les champs et vérifier que les mots de passe sont identiques.</p>";
          } else {
        
            // Connexion à la base de données
            $serveur = "127.0.0.1";
            $utilisateur = "gqzrbsbc_vvermorel";
            $mot_de_passe = "Japon_2008@";
            $base_de_donnees = "gqzrbsbc_sitedufeu";
            $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

            // Vérification que la connexion est réussie
            if (!$connexion) {
              echo "<p>Erreur : impossible de se connecter à la base de données.</p>";
            } else {
                // Insertion du nouvel utilisateur dans la base de données
              $requete = "INSERT INTO utilisateurs (prenom, email, mdp) VALUES ('$prenom', '$email', md5('$mdp'))";
              $resultat = mysqli_query($connexion, $requete);
              // Vérification que l'insertion est réussie
              if (!$resultat) {
                echo "<p>Erreur : impossible d'insérer le nouvel utilisateur dans la base de données.</p>";
              } else {
                echo "<p>Le nouvel utilisateur a bien été enregistré dans la base de données.</p>";
              }

              // Fermeture de la connexion à la base de données
              mysqli_close($connexion);
            }
          }
        }
      ?>
      <form action="incription.php" method="post">
        <label for="nom">Pseudonyme :</label>
        <input type="text" name="prenom" id="prenom" placeholder="Votre Pseudonyme" required>
        <label for="email">Adresse e-mail :</label>
        <input type="email" name="email" id="email" placeholder="Votre adresse mail" required>
        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe" required>
        <label for="mdp_confirmation">Confirmation du mot de passe :</label>
        <input type="password" name="mdp_confirmation" id="mdp_confirmation" placeholder="Confirmez votre mot de passe" required>
        <button type="submit">S'inscrire</button>
      </form>
      <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a></p>
    </main>
    <footer>
      <p>Copyright © 2023 Forum des passionnés du feu</p>
    </footer>
  </body>
</html>