<?php
session_start();
// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION["id_test"]) || !isset($_SESSION["pseudo"])) {
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

$connect_bdd = mysqli_connect("127.0.0.1", "root", "", "quizzeo");
$id_test = $_GET['id_test'];
$id_quizz = $_GET['id_quizz'];
$score = $_GET['score'];

// Sélection des questions
$test = "SELECT * FROM questions WHERE id_quizz='$id_quizz'";
$result = mysqli_query($connect_bdd, $test);
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
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
                                <br><p class="bonjour">Compte de <span><?php echo ucfirst($_SESSION["pseudo"]); ?></span></p>
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
    <div class="cuicuiz">
        <div class="liquest">
            <h2>Résultats</h2>
        </div>
        <div class="container">
            <h3>Votre score : <?php echo $score; ?></h3>
            <h4>Bonnes réponses :</h4>
            <?php
            if ($result->num_rows > 0) {
                $questionIndex = 0; // Indice pour suivre la question actuelle
                // Parcourir les questions
                while ($row = $result->fetch_assoc()) {
                    $questionId = $row['id_question'];
                    $questionText = $row['intitule'];

                    // Sélection de la bonne réponse pour la question actuelle
                    $sql = "SELECT * FROM choices WHERE id_question='$questionId'";
                    $resulte = mysqli_query($connect_bdd, $sql);
                    ?>
                    <div class="card bg-light cache">
                        <?php
                            if ($resulte->num_rows > 0) {
                                // Afficher la bonne réponse
                                while ($row = $resulte->fetch_assoc()) {
                                    $responseText = $row["bonne_reponse"];
                                    echo "<p>Question " . ($questionIndex + 1) . ": $questionText</p>";
                                    echo "<p>Bonne réponse : $responseText</p>";
                                }
                            }
                            $questionIndex++; // Augmenter l'indice de la question actuelle
                        }
                    } else {
                        echo "Aucune question trouvée.";
                    }
                ?>
                <a href="<?php 
                            if ($_SESSION["role"] === "quizzer") {
                                echo "quizzer.php";
                            } elseif ($_SESSION["role"] === "admin") {
                                echo "admin.php";
                            } else {
                                echo "user.php";
                            }
                        ?>">
                    <button>Jouer à d'autres Quizz</button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
