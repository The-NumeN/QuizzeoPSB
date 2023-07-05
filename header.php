<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
      <link rel="stylesheet" href="connect2.css">
    </head>
  <body>
    <div class="hed">
    <nav class="navbar navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- ajout du logo (retour au menu principal lorsque l'on clique dessus) -->
        <a href="index.php"><img class="navbar-brand" src="img/logo-quiz-symboles-bulle-dialogue-concept-spectacle-questionnaire-chante-bouton-quiz-concours-questions-examen-embleme-moderne-interview_180786-72.avif" width="75" height="75" class="d-inline-block align-center" alt="Erreur"></a>
        <div class="navbar" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                session_start();
                if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
                  // Détruire la session
                  session_destroy();
                
                  // Rediriger vers la page de connexion
                  header("location: index.php");
                  exit();
                }
                if (isset($_SESSION["pseudo"])) {
                    // Utilisateur connecté
                    echo '
                    <div class="inscri">
                        <li class="nav-item">
                            <br><p class="bonjour">Compte de <span>'.ucfirst($_SESSION["pseudo"]).'</span></p>
                        </li>
                    </div>
                    <div class="form-inline">
                        <li class="nav-item">
                            <form action="" method="post">
                                <input type="hidden" name="logout" value="true">
                                <div class="tamere">
                                    <button class="deco">
                                        <img src="img\portal.png" width="60px" height="60px" class="d-inline-block align-center" alt="">
                                    </button>
                                </div>
                            </form>                            
                        </li>
                    </div>';
                } else {
                    // Utilisateur non connecté
                    echo '
                    <div class="inscriP">
                        <li class="nav-item">
                            <a id="inscri" class="nav-link" href="inscription.php">Inscription</a>
                        </li>
                    </div>
                    <div class="connT">
                        <li class="nav-item">
                            <a id="conn" class="nav-link" href="connexion.php">Connexion</a>
                        </li>
                    </div>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

    </div>
    <br>
  </body>
</html>