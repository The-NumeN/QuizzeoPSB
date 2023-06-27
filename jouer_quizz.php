<?php
session_start();
if (!isset($_SESSION["pseudo"]) && $_SESSION["role"] !== "utilisateur") {
    header("location: Connexion.php");
    exit();
}

if (isset($_GET['id_quizz'])) {
    // Récupérer l'identifiant du quiz sélectionné depuis l'URL
    $id_quizz = $_GET['id_quizz'];

    function BDDconnect() {
        $connect_bdd = mysqli_connect("127.0.0.1", "root", "", "quizzeo");
        if (!$connect_bdd) {
            die("Échec de la connexion à la base de données: " .mysqli_error($connect_bdd));
        }
        return $connect_bdd;
    }

    $connect = BDDconnect();

    $query = "SELECT * FROM Questions WHERE id_quizz = $id_quizz";
    $result = mysqli_query($connect, $query);
    $questions = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $questions[] = $row;
    }

    foreach ($questions as &$question) {
        $id_question = $question['id_question'];
        $query_reponses = "SELECT * FROM choices WHERE id_question = $id_question";
        $result_reponses = mysqli_query($connect, $query_reponses);
        $reponses = [];

        while ($row = mysqli_fetch_assoc($result_reponses)) {
            $reponses[] = $row;
        }
        $question['reponses'] = $reponses;
    }
} else {

    echo "Aucun quiz n'est sélectionné.";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions du Quiz</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <h2>Questions du Quiz</h2>

    <?php foreach ($questions as $question) : ?>
        <h3><?php echo $question['intitule']; ?></h3>
        <ul>
            <?php foreach ($question['reponses'] as $reponse) : ?>
                <button><?php echo $reponse['bonne_reponse']; ?></button><br><br>
                <button><?php echo $reponse['reponse']; ?></button><br><br>
                <button><?php echo $reponse['reponce']; ?></button><br><br>
                <button><?php echo $reponse['reponze']; ?></button>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
</body>
</html>