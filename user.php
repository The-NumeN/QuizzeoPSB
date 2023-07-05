<?php
session_start();
// Vérifier si l'utilisateur est connecté en tant que user, sinon rediriger vers la page de connexion
if (!isset($_SESSION["pseudo"]) || $_SESSION["role"] !== "utilisateur") {
    header("location: Connexion.php");
    exit();
}
if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    session_destroy();
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
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="connectE.css">
    </head>

    <body>
        <!-- HEADER -->
        <div class="hed">
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container-fluid">
            <!-- ajout du logo (retour au menu principal lorsque l'on clique dessus) -->
                <a href="index.php"><img class="navbar-brand" src="img/logo-quiz-symboles-bulle-dialogue-concept-spectacle-questionnaire-chante-bouton-quiz-concours-questions-examen-embleme-moderne-interview_180786-72.avif" width="75" height="75" class="d-inline-block align-center" alt="Erreur"></a>
                <div class="navbar" id="navbarNav">
                    <ul class="navbar-nav  ">
            <!-- ajout des liens de redirection -->
                        <div class="inscri">
                            <li class="nav-item">
                                <br><p class="bonjour">Bonjour <span><?php echo ucfirst($_SESSION["pseudo"]); ?></span></p>
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
        </div><br><br>
       
             <h2>Liste des quizz</h2><br>
             
                <?php foreach ($quizzes as $quiz) : ?>
                    <div class="zoom">
                                <span class="intil"><?php echo $quiz['titre']; ?></span><br>
                                <span><?php $difficulte = $quiz['difficulte'];
                                            $difficulteText = "";
                                            if ($difficulte == 1) {
                                                $difficulteText = "Facile";
                                            } elseif ($difficulte == 2) {
                                                $difficulteText = "Moyen";
                                            } elseif ($difficulte == 3) {
                                                $difficulteText = "Difficile";
                                            }
                                            echo $difficulteText;
                                        ?>
                                </span><br><br><br>                                         
                            <div class="card-body">                
                                <a href="jouer_quizz.php?id_quizz=<?php echo $quiz['id_quizz']; ?>"><button>Jouer</button></a><br>
                            </div>
                        </div>
                    </div>
                    </div>
                    <br>
                <?php endforeach; ?>
        <br><br><br><br>
        <footer class="fixed_footer">
  <div class="content">
    <p>&copy; - Stive Gamy  -  Babacar Gueye -  Paul Vicens </p>
  </div>
</footer>
        <script src="Scripts.js"></script>
  </body>
  
</html>    

