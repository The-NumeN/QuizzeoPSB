<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'admin, sinon rediriger vers la page de connexion
if (!isset($_SESSION["pseudo"]) && $_SESSION["role"] !== "admin") {
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
    <title>Modifier Quizz</title>
</head>
<body>
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
    </form>
</body>
</html>