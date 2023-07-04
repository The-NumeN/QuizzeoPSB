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
$id_test = $_SESSION['id_test'];
$id_quizz = $_GET['id_quizz'];

$stp = $_GET['id_quizz'];

// Sélection des questions
$test = "SELECT * FROM questions WHERE id_quizz='$stp'";
$result = mysqli_query($connect_bdd, $test);
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jouer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
<div class="cuicuiz">
    <div class="liquest">
        <h2>Liste des questions</h2>
    </div>
    <div class="container">
        <form method="post" action="">
        <?php
    if ($result->num_rows > 0) {
        $questionIndex = 0; // Indice pour suivre la question actuelle
        // Parcourir les questions
        while ($row = $result->fetch_assoc()) {
            $questionId = $row['id_question'];
            $questionText = $row['intitule'];

            // Sélection des réponses pour la question actuelle et les mélanger
            $sql = "SELECT * FROM choices WHERE id_question='$questionId'";
            $resulte = mysqli_query($connect_bdd, $sql);
            $responses = array();
            if ($resulte->num_rows > 0) {
                while ($row = $resulte->fetch_assoc()) {
                    $responses[] = $row;
                }
                shuffle($responses); // Mélanger les réponses
            }
            ?>
            <div class="card bg-light cache">
                <div class="card-header">
                    <?php echo $questionText; ?>
                </div>
                <div class="card-body">
                    <?php
                    if (!empty($responses)) {
                        foreach ($responses as $response) {
                            $responseText = $response["bonne_reponse"];
                            $responseText1 = $response["reponse"];
                            $responseText2 = $response["reponce"];
                            $responseText3 = $response["reponze"];
                            $responseValues = array($responseText, $responseText1, $responseText2, $responseText3);
                            shuffle($responseValues); // Mélanger les valeurs des réponses
                            ?>
                            <input type="radio" name="reponse<?php echo $questionIndex; ?>" value="<?php echo $responseValues[0]; ?>">
                            <label><?php echo $responseValues[0]; ?></label>
                            <br>
                            <input type="radio" name="reponse<?php echo $questionIndex; ?>" value="<?php echo $responseValues[1]; ?>">
                            <label><?php echo $responseValues[1]; ?></label>
                            <br>
                            <input type="radio" name="reponse<?php echo $questionIndex; ?>" value="<?php echo $responseValues[2]; ?>">
                            <label><?php echo $responseValues[2]; ?></label>
                            <br>
                            <input type="radio" name="reponse<?php echo $questionIndex; ?>" value="<?php echo $responseValues[3]; ?>">
                            <label><?php echo $responseValues[3]; ?></label>
                            <br>
                            <?php
                        }
                    } else {
                        echo "Aucune réponse trouvée.";
                    }
                    ?>
                </div>
            </div>
            <?php
            $questionIndex++; // Augmenter l'indice de la question actuelle
        }
        ?>
        <input type="button" id='pre' onclick='plusSlide(-1)' value="Précédent">
        <input type="button" id='sui' onclick='plusSlide(1)' value="Suivant"><br>
        <input type="submit" value="Valider">
    <?php
    } else {
        echo "Aucune question trouvée.";
    }
            // Vérifier si le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $score = 0;
                // Parcourir les réponses soumises par l'utilisateur
                foreach ($_POST as $key => $value) {
                    // Récupérer l'indice de la question à partir de la clé
                    $questionIndex = substr($key, 7); // Supprimer la partie "reponse" pour obtenir l'indice
                
                    // Récupérer la réponse correcte pour cette question
                    $correctResponse = $responses[$questionIndex]["bonne_reponse"];
                
                    // Vérifier si la valeur correspond à la réponse correcte
                    if ($value === $correctResponse) {
                        // Incrémenter le score de l'utilisateur de 10
                        $score += 10;
                    }
                }
                

                // Vérifier si l'utilisateur a déjà répondu à ce test et ce quizz dans la table user_quizz
                $checkQuery = "SELECT * FROM user_quizz WHERE id_test='$id_test' AND id_quizz='$id_quizz'";
                $checkResult = mysqli_query($connect_bdd, $checkQuery);

                if ($checkResult->num_rows > 0) {
                    // L'utilisateur a déjà répondu à ce test et ce quizz, donc mettez à jour le score existant
                    $updateQuery = "UPDATE user_quizz SET score = score + $score WHERE id_test='$id_test' AND id_quizz='$id_quizz'";
                    mysqli_query($connect_bdd, $updateQuery);
                } else {
                    // L'utilisateur n'a pas encore répondu à ce test et ce quizz, donc insérez un nouveau score
                    $insertQuery = "INSERT INTO user_quizz (id_test, id_quizz, score) VALUES ('$id_test', '$id_quizz', '$score')";
                    mysqli_query($connect_bdd, $insertQuery);
                }
                // Redirection vers la page des résultats avec le score et les bonnes réponses
                // header("Location: Resultats.php?score=$score&id_test=$id_test&id_quizz=$id_quizz");
                // exit();
            }
            ?>
        </form>
        <script src="scripts.js"></script>

    </div>
    </div><br><br>
    <footer class="fixed_footer">
  <div class="content">
    <p>&copy; - Stive Gamy  -  Babacar Gueye -  Paul Vicens </p>
  </div>
</footer>
</body>

</html>
