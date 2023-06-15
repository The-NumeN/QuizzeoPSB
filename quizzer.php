<?php
include 'header.php';
?>
<!DOCTYPE html>
<!-- page quizzeur -->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quizzer</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="connect2.css">
        <script src="creaquestion.js" type="text/javaScript"></script>
    </head>
    <body>
    <h1>Bonjour <span><?php echo ucfirst($_SESSION["pseudo"]); ?></span>, Bienvenue !</h1><br>
    <!-- bouton avec appel de fonction pour jouer aux quizz et en créer -->
        <div class="jouer">
        <input type="button"onclick="selectquizz()"value="Jouer"/><br><br>
        <div id="play"></div>
        </div>
        <div class="créer">
        <input type="button" onclick="addquizz()" value="Créer un quizz"/><br></br>
        </div>
        <div id="crea"></div>
        <div id="crea1"></div> 
        
    </body>
</html>