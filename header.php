<!DOCTYPE html>
<!-- Barre de navigation du site -->

<?php 
  if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion
    header("location: Connexion.php");
    exit();
}
?>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
      <title>Quizzeo</title>
  </head>
  <body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
      <div class="container-fluid">
      <!-- ajout du logo (retour au menu principal lorsque l'on clique dessus) -->
        <a href="index.php"><img class="navbar-brand" src="img/logo-quiz-symboles-bulle-dialogue-concept-spectacle-questionnaire-chante-bouton-quiz-concours-questions-examen-embleme-moderne-interview_180786-72.avif" width="75" height="75" class="d-inline-block align-top" alt="Erreur"></a>
        
        <div class="navbar" id="navbarNav">
          <ul class="navbar-nav  ">
          <!-- ajout des liens de redirection -->
          <div class="inscri">
            <li class="nav-item">
              <a class="nav-link" href="inscription.php">Inscription</a>
            </li>
          </div>
          <div class="conn">
            <li class="nav-item">
              <a class="nav-link" href="connexion.php">Connexion</a>
            </li>
          </div>
            <div class="deco">
              <li class="nav-item">
                <form action="" method="post">
                  <input type="hidden" name="logout" value="true">
                  <button type="submit">Déconnexion</button>
                </form>
              </li>
            </div>
          </ul>
        </div>
      </div>
    </nav>
    <br>
  </body>
</html>