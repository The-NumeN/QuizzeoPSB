<?php
    include 'header.php';
?>
<?php
session_start();

if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion
    header("location: Connexion.php");
    exit();
}
?>
<!DOCTYPE html>
<!-- page joueur -->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Joueurs</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="connect2.css">
        <script src="creaquestion.js" type="text/javaScript"></script>
    </head>
    <body>
    <h1>Bonjour <span><?php echo ucfirst($_SESSION["pseudo"]); ?></span>, Bienvenue !</h1><br>
    <h2>Cliquez sur le bouton pour jouer</h2>
        <div class="jouer">
            <input type="button"onclick="selectquizz()"value="Jouer"/><br><br>
            <div id="play"></div>
        </div>
    </body>
</html>    