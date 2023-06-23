<?php 
    session_start();
  if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion
    header("location: Connexion.php");
    exit();
}
// Vérifier si l'utilisateur est connecté en tant que quizzer, sinon rediriger vers la page de connexion
if (!isset($_SESSION["pseudo"]) && $_SESSION["role"] !== "quizzer") {
    header("location: Connexion.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head> <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quizzer</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="connect2.css">
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
                                <br><p class="bonjour">Bonjour <span><?php echo ucfirst($_SESSION["pseudo"]); ?></span>, Bienvenue !</p>
                            </li>
                        </div>
                        <div class="conn">
                            <li class="nav-item">
                                <form action="" method="post">
                                    <input type="hidden" name="logout" value="true">
                                    <button type="submit">Déconnexion</button>
                                </form>
                            </li>
                        </div>
                        <div class="deco">
                            <li class="nav-item">
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br>
        <div class="container">
            <div class="card bg-light">
                <div class="card-header">
                    <h3>Liste des quizz</h3>
                </div>
                <div class="card-body">
                    <a href="quizz_list.php">Voir la liste des quizz</a>
                </div>
            </div>
            <br><br>
            <div class="card bg-light">
                <div class="card-header">
                    <h3>Ajouter un quizz</h3>
                </div>
                <div class="card-body">
                    <a href="ajout_quiz.php">Ajouter un quizz</a>
                </div>
            </div>            
        </div>
    </body>

</html>