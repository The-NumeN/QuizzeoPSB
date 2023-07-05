<?php 
    session_start();
// Vérifier si l'utilisateur est connecté en tant que quizzer, sinon rediriger vers la page de connexion
if (!isset($_SESSION["pseudo"]) || $_SESSION["role"] !== "quizzer") {
    header("location: Connexion.php");
    exit();
}
if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion
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

$test = $_SESSION["id_test"];
$q = "SELECT * FROM Quizzes WHERE id_test = '$test'";
$resulte = mysqli_query($connect, $q);
$quizze = [];

while ($row = mysqli_fetch_assoc($resulte)) {
  $quizze[] = $row;
}

?>
<!DOCTYPE html>
<html>
    <head> <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quizzer</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="connect2.css">

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
        <br><br>
        <h2>Liste des quizz</h2><br>
        <div class="row">
                <?php foreach ($quizzes as $quiz) : ?>
                    <div class="col-xl-4 col-lg-4">
                        <!--<div class="column">
                             <div class="carde"> -->
                                <div class="zoom">
                                    <span class="intil">
                                        <?php echo $quiz['titre']; ?>
                                    </span><br><br>
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
                            <!-- </div> 
                        </div>-->
                    </div>    
                    <br>
                <?php endforeach; ?>
        </div>
            <div class="border border-secondary rounded bloped">
                <div class="card bg-light">
                    <div class="card-header">
                        <h3>Mes quizz</h3>
                    </div>
                    <div class="card-body">
                        <table> 
                            <tr>
                                <th>Titre</th>
                                <th>Difficulte</th>
                                <th>Actions</th>
                            </tr>
                            <?php foreach ($quizze as $quiz) : ?>
                            <tr>
                                <td><?php echo $quiz['titre']; ?></td>
                                <td><?php
                                        $difficulte = $quiz['difficulte'];
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
                                </td>
                                <td>
                                <a href="edit_quizz_ad.php?id_quizz=<?php echo $quiz['id_quizz']; ?>"><img src='img/edit.png' width='30px'></a>
                                    <a href="supp_quizz.php?id_quizz=<?php echo $quiz['id_quizz']; ?>"><img src='img/delete.png' width='30px'></a>
                                    <a href="jouer_quizz.php?id_quizz=<?php echo $quiz['id_quizz']; ?>"><button>Jouer</button></a><br>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                        <a href="ajout_quiz.php"><button> Ajouter un quizz</button></a>
                    </div>
                </div>
            </div>
        </div><br><br><br>
        <footer class="fixed_footer">
            <div class="content">
                <p>&copy; - Stive Gamy  -  Babacar Gueye -  Paul Vicens </p>
            </div>
        </footer>
    </body>
</html>