<?php
// Informations de connexion à la base de données
$servername = "127.0.0.1"; // Nom du serveur
$username = "gqzrbsbc_tmprXr6C"; // Nom d'utilisateur
$password = ""; // Mot de passe de l'utilisateur
$dbname = "gqzrbsbc_sitedufeu"; // Nom de la base de données

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
?>
