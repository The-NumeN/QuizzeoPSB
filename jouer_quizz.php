<?php
session_start();
if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    session_destroy();
    header("location: Connexion.php");
    exit();
}
// Vérifier si l'utilisateur est connecté en tant que user, sinon rediriger vers la page de connexion
if (!isset($_SESSION["pseudo"]) && $_SESSION["role"] !== "utilisateur"."quizzer") {
    header("location: Connexion.php");
    exit();
}
$connect_bdd = mysqli_connect("127.0.0.1", "root", "", "quizzeo");
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
        <title>Connexion</title>
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
                    <ul class="navbar-nav">
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
                    <div class="card bg-light <?php echo ($questionIndex > 0) ? 'hidden' : ''; ?>">
                        <div class="card-header">
                            <?php echo $questionText; ?>
                        </div>
                        <div class="card-body">
                            <?php
                            if ($resulte->num_rows > 0) {
                                // Parcourir les réponses de la question actuelle
                                while ($row = $resulte->fetch_assoc()) {
                                    $responseId = $row["id_choice"];
                                    $responseText = $row["bonne_reponse"];
                                    $responseText1 = $row["reponse"];
                                    $responseText2 = $row["reponce"];
                                    $responseText3 = $row["reponze"];
                                    ?>
                                    <input type="radio" name="bonne_reponse<?php echo $questionIndex; ?>" value="<?php echo $responseId; ?>">
                                    <label><?php echo $responseText; ?></label>
                                    <br>
                                    <input type="radio" name="reponse<?php echo $questionIndex; ?>" value="<?php echo $responseId; ?>">
                                    <label><?php echo $responseText1; ?></label>
                                    <br>
                                    <input type="radio" name="reponce<?php echo $questionIndex; ?>" value="<?php echo $responseId; ?>">
                                    <label><?php echo $responseText2; ?></label>
                                    <br>
                                    <input type="radio" name="reponze<?php echo $questionIndex; ?>" value="<?php echo $responseId; ?>">
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
                <input type="button" value="Valider" onclick="afficherProchaineQuestion()">
            <?php
            } else {
                echo "Aucune question trouvée.";
            }
            ?>
        </form>
</html>
