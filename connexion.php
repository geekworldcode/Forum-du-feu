<?php
session_start();

if (isset($_POST['email']) && isset($_POST['mdp'])) {
    // Connexion à la base de données
    $db_host = "127.0.0.1";
    $db_name = "gqzrbsbc_sitedufeu";
    $db_user = "gqzrbsbc_vvermorel";
    $db_pass = "Japon_2008@";
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    // Vérification des identifiants de connexion
    $email = $_POST['email'];
    $mdp = md5($_POST['mdp']);
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email=:email AND mdp=:mdp");
    $stmt->execute(['email' => $email, 'mdp' => $mdp]);
    $user = $stmt->fetch();

    if ($user !== false) {
        // Authentification réussie
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.hmtl');
        exit();
    } else {
        // Authentification échouée
        $erreur = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Connexion - Forum des passionnés du feu</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body class="register">
    <header>
      <h1>Forum des passionnés du feu</h1>
      <div class="mon-compte">
        <a href="index.html">Accueil</a>
     </div>
    </header>
    <main>
      <h2>Connexion</h2>
      <?php if (isset($erreur)) { ?>
        <p class="erreur"><?php echo $erreur; ?></p>
      <?php } ?>
      <form action="connexion.php" method="post">
        <label for="email">Adresse e-mail :</label>
        <input type="email" name="email" id="email" placeholder="Votre adresse mail" required>
        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe" required>
        <button type="submit">Se connecter</button>
      </form>
      <p>Pas de compte ? <a href="inscription.php">Inscrivez-vous ici</a></p>
    </main>
    <footer>
      <p>© 2023 Forum des passionnés du feu</p>
    </footer>
  </body>
</html>
