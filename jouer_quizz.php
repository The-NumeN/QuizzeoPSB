<?php

session_start();
if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion
    header("location: Connexion.php");
    exit();
}
// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION["id_test"]) || !isset($_SESSION["pseudo"])) {
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
    <link rel="stylesheet" href="connect.css">
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

                    // Sélection des réponses pour la question actuelle
                    $sql = "SELECT * FROM choices WHERE id_question='$questionId'";
                    $resulte = mysqli_query($connect_bdd, $sql);
                    ?>
                    <div class="card bg-light cache">
                        <div class="card-header">
                            <?php echo $questionText; ?>
                        </div>
                        <div class="card-body">
                            <?php
                            if ($resulte->num_rows > 0) {
                                // Parcourir les réponses de la question actuelle
                                while ($row = $resulte->fetch_assoc()) {
                                    $responseText = $row["bonne_reponse"];
                                    $responseText1 = $row["reponse"];
                                    $responseText2 = $row["reponce"];
                                    $responseText3 = $row["reponze"];
                                    ?>
                                    <input type="radio" name="reponse<?php echo $questionIndex; ?>" value="bonne_reponse">
                                    <label><?php echo $responseText; ?></label>
                                    <br>
                                    <input type="radio" name="reponse<?php echo $questionIndex; ?>" value="reponse">
                                    <label><?php echo $responseText1; ?></label>
                                    <br>
                                    <input type="radio" name="reponse<?php echo $questionIndex; ?>" value="reponce">
                                    <label><?php echo $responseText2; ?></label>
                                    <br>
                                    <input type="radio" name="reponse<?php echo $questionIndex; ?>" value="reponze">
                                    <label><?php echo $responseText3; ?></label>
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
                $score = 0; // Score de l'utilisateur
                // Parcourir les réponses soumises par l'utilisateur
                foreach ($_POST as $key => $value) {
                    // Vérifier si la clé commence par "reponse" et si la valeur est "bonne_reponse"
                    if (strpos($key, 'reponse') === 0 && $value === 'bonne_reponse') {
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
            }
            ?>
        </form>
        <script src="scripts.js"></script>

    </div>
    </div>
</body><br>
<footer class="fixed_footer">
  <div class="content">
    <p>&copy; - Stive Gamy  -  Babacar Gueye -  Paul Vicens </p>
  </div>
</footer>
</html>
