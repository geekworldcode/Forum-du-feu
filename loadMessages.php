<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=gqzrbsbc_vincent;charset=utf8;', 'gqzrbsbc_vincent', 'Japon_2008@');
$recupMessages = $bdd->prepare('SELECT * FROM messages ORDER BY id DESC');
$recupMessages->execute(); // exécution de la requête
$messages = $recupMessages->fetchAll(); // récupération de tous les résultats
foreach ($messages as $message) {
?>
    <div class="message">
        <h4><?= $message['pseudo']; ?></h4>
        <p><?= $message['message']; ?></p>
    </div>
<?php 
}
?>
