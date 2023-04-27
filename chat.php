<?php
try {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=gqzrbsbc_vincent;charset=utf8;', 'gqzrbsbc_vincent', 'Japon_2008@');
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
$messageValidation = "";
if(isset($_POST['valider'])){
    if(!empty($_POST['pseudo']) and !empty($_POST['message'])){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $message = nl2br(htmlspecialchars($_POST['message']));

        $insererMessage = $bdd->prepare('INSERT INTO messages(pseudo, message) VALUES(?, ?)');
        $insererMessage->execute(array($pseudo, $message));

        $messageValidation = "Le message a été envoyé avec succès.";
    }else{
        $messageValidation = "Veuillez compléter tous les champs";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="chat.css">
</head>
<body>
    <header>
		<h1>Forum des passionnes du feu</h1>
        <div class="mon-compte">
        <a href="account.php">Mon compte</a>
         </div>         
	</header>
	<nav>
		<ul>
			<li><a href="menu.php">Accueil</a></li>
			<li><a href="chat.php">Chat</a></li>
			<li><a href="post.php">Posts</a></li>
			<li><a href="account.php">Mon compte</a></li>
		</ul>
	</nav>

    <form method="POST" action="" align="center">
        <input type="text" name="pseudo" placeholder="Votre nom">
        <br><br>
        <textarea name="message" placeholder="Votre message"></textarea>
        <br>
        <input type="submit" name="valider">
    </form>
    <div class="validation">
        <?php echo $messageValidation; ?>
    </div>
    <section id="messages"></section>

    <script>
        setInterval('load_messages()', 500);
        function load_messages(){
            $('#messages').load('loadMessages.php')
        }
    </script>
    <footer>
			<p>&copy; 2023 Forum des passionnés du feu</p>
	</footer>
</body>
</html>