<?php
session_start();
// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION["id_test"]) || !isset($_SESSION["pseudo"]) || ($_SESSION["role"] !== "quizzer" && $_SESSION["role"] !== "admin")) {
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

if (isset($_GET["id_quizz"])) {
    $idQuizz = $_GET["id_quizz"];
    // Établir la connexion à la base de données
    $connect_bdd =  mysqli_connect("127.0.0.1", "root", "", "quizzeo");

    // Récupérer les informations du quizz
    $queryQuizz = "SELECT * FROM quizzes WHERE id_quizz = '$idQuizz'";
    $resultQuizz = mysqli_query($connect_bdd, $queryQuizz);
    $quizzData = mysqli_fetch_assoc($resultQuizz);

    // Récupérer les questions du quizz
    $queryQuestions = "SELECT * FROM questions WHERE id_quizz = '$idQuizz'";
    $resultQuestions = mysqli_query($connect_bdd, $queryQuestions);
    $questions = array();
    while ($row = mysqli_fetch_assoc($resultQuestions)) {
        $questions[] = $row;
    }


    if (isset($_POST["submit"])) {
        // Mettre à jour les informations du quizz dans la base de données
        $titre = $_POST["titre"];
        $difficulte = $_POST["difficulte"];

        $updateQuizzQuery = "UPDATE quizzes SET titre = '$titre', difficulte = '$difficulte' WHERE id_quizz = '$idQuizz'";
        mysqli_query($connect_bdd, $updateQuizzQuery);

        // Mettre à jour les questions et réponses du quizz dans la base de données
        foreach ($_POST["questions"] as $questionId => $questionData) {
            $intitule = $questionData["intitule"];
            $updateQuestionQuery = "UPDATE questions SET intitule = '$intitule' WHERE id_question = '$questionId'";
            mysqli_query($connect_bdd, $updateQuestionQuery);

            foreach ($questionData["choices"] as $choiceId => $choiceData) {
                $bonne_reponse = $choiceData["bonne_reponse"];
                $reponse = $choiceData["reponse"];
                $reponce = $choiceData["reponce"];
                $reponze = $choiceData["reponze"];
                $updateChoiceQuery = "UPDATE choices SET reponse = '$reponse', reponce = '$reponce', reponze = '$reponze', bonne_reponse = '$bonne_reponse' WHERE id_choice = '$choiceId'";
                mysqli_query($connect_bdd, $updateChoiceQuery);
            }
        }

        // Rediriger vers la page d'administration
        header("location: admin.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Quizz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="connectE.css">
</head>
<body>
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container-fluid">
                <a href="index.php"><img class="navbar-brand" src="img/logo-quiz-symboles-bulle-dialogue-concept-spectacle-questionnaire-chante-bouton-quiz-concours-questions-examen-embleme-moderne-interview_180786-72.avif" width="75" height="75" class="d-inline-block align-center" alt="Erreur"></a>
                <div class="navbar" id="navbarNav">
                    <ul class="navbar-nav">
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
    <h1>Modifier Quizz</h1>
    <form action="" method="post">
        <label for="titre">Titre:</label>
        <input type="text" name="titre" value="<?php echo $quizzData['titre']; ?>" required><br><br>

        <label for="difficulte">Difficulté:</label>
        <select name="difficulte" required>
            <option value="1" <?php if ($quizzData['difficulte'] == 1) echo 'selected'; ?>>Facile</option>
            <option value="2" <?php if ($quizzData['difficulte'] == 2) echo 'selected'; ?>>Moyen</option>
            <option value="3" <?php if ($quizzData['difficulte'] == 3) echo 'selected'; ?>>Difficile</option>
        </select><br><br>

        <?php foreach ($questions as $question): ?>
            <label>Intitule: </label>
            <input type="text" name="questions[<?php echo $question['id_question']; ?>][intitule]" value="<?php echo $question['intitule']; ?>" required><br>

            <?php
            $queryChoices = "SELECT * FROM choices WHERE id_question = '{$question['id_question']}'";
            $resultChoices = mysqli_query($connect_bdd, $queryChoices);
            $choices = array();
            while ($row = mysqli_fetch_assoc($resultChoices)) {
                $choices[] = $row;
            }

            ?>
            <?php foreach ($choices as $choice): ?>
                <label>Bonne Réponse: </label>
                <input type="text" name="questions[<?php echo $question['id_question']; ?>][choices][<?php echo $choice['id_choice']; ?>][bonne_reponse]" value="<?php echo $choice['bonne_reponse']; ?>" required><br><br>
             
                <label>Mauvaise Réponse: </label>
                <input type="text" name="questions[<?php echo $question['id_question']; ?>][choices][<?php echo $choice['id_choice']; ?>][reponse]" value="<?php echo $choice['reponse']; ?>" required><br><br>
                
                <label>Mauvaise Réponse: </label>
                <input type="text" name="questions[<?php echo $question['id_question']; ?>][choices][<?php echo $choice['id_choice']; ?>][reponce]" value="<?php echo $choice['reponce']; ?>" required><br><br>
             
                <label>Mauvaise Réponse: </label>
                <input type="text" name="questions[<?php echo $question['id_question']; ?>][choices][<?php echo $choice['id_choice']; ?>][reponze]" value="<?php echo $choice['reponze']; ?>" required><br>
                <?php endforeach; ?>

            <br>
        <?php endforeach; ?>

        <button type="submit" name="submit">Modifier</button>
    </form><br><br><br>
    <footer class="fixed_footer">
  <div class="content">
    <p>&copy; - Stive Gamy  -  Babacar Gueye -  Paul Vicens </p>
  </div>
</footer>
</body>

</html>
