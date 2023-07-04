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
function BDDconnect() {
    $connect_bdd = mysqli_connect("127.0.0.1", "root", "", "quizzeo");
    if (!$connect_bdd) {
        die("Échec de la connexion à la base de données: " .mysqli_error($connect_bdd));
    }
    return $connect_bdd;
  }
  $connect = BDDconnect();
  
  $query = "SELECT * FROM Quizzes";
  $result = mysqli_query($connect, $query);
  $quizzes = [];
  
  while ($row = mysqli_fetch_assoc($result)) {
    $quizzes[] = $row;
  }
?>
<!DOCTYPE html>
<html>
    <head> <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quizzer</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="connectE.css">
    </head>
    <body>
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container-fluid">
            <!-- ajout du logo (retour au menu principal lorsque l'on clique dessus) -->
                <a href="index.php"><img class="navbar-brand" src="img/logo-quiz-symboles-bulle-dialogue-concept-spectacle-questionnaire-chante-bouton-quiz-concours-questions-examen-embleme-moderne-interview_180786-72.avif" width="75" height="75" class="d-inline-block align-center" alt="Erreur"></a>
        
                <div class="navbar" id="navbarNav">
                    <ul class="navbar-nav  ">
          <!-- ajout des liens de redirection -->
                        <div class="inscri">
                            <li class="nav-item">
                                <br><p class="bonjour">Bonjour <span><?php echo ucfirst($_SESSION["pseudo"]); ?></span>, Bienvenue !</p>
                            </li>
                        </div>
                        <div class="form-inline">
                            <li class="nav-item">
                            <form action="" method="post">
                                    <input type="hidden" name="logout" value="true">
                                    <div class="tamere"><button class="deco"><img src="img\portal.png"width="60px" height="60px" class="d-inline-block align-center" alt=""></button></div>
                                </form>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br>
        <div class="container">
        <h2>Liste des quizz</h2><br>
                <?php foreach ($quizzes as $quiz) : ?>
                    <div class="border border-secondary rounded bloped">
                        <div class="card blopee">
                            <div class="card-header">
                                <span><?php echo $quiz['titre']; ?></span><br>
                                <span><?php echo $quiz['difficulte']; ?></span>                                          
                            </div>
                            <div class="card-body">                
                                <a href="jouer_quizz.php?id_quizz=<?php echo $quiz['id_quizz']; ?>"><button>Jouer</button></a><br>
                            </div>
                        </div>
                    </div>
                    <br>
                <?php endforeach; ?>
            <br><br>
            <div class="border border-secondary rounded bloped">
                <div class="card bg-light">
                    <div class="card-header">
                        <h3>Ajouter un quizz</h3>
                    </div>
                    <div class="card-body">
                        <a href="ajout_quiz.php"><button> Ajouter un quizz</button></a>
                    </div>
                </div>            
            </div>
        </div>

    </body><br>
    <footer class="fixed_footer">
  <div class="content">
    <p>&copy; - Stive Gamy  -  Babacar Gueye -  Paul Vicens </p>
  </div>
</footer>
</html>