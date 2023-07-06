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
// Récupérer l'ID de l'utilisateur connecté
$connect_bdd = mysqli_connect("127.0.0.1", "root", "", "quizzeo");
$id_test = $_SESSION['id_test'];

// Requête SQL pour récupérer les scores de l'utilisateur
$sql = "SELECT quizzes.titre AS nom_quiz, user_quizz.score FROM user_quizz
        INNER JOIN quizzes ON user_quizz.id_quizz = quizzes.id_quizz
        WHERE user_quizz.id_test = $id_test";

$resultat = mysqli_query($connect_bdd, $sql);
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Scores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
    <h1>Mes Scores</h1>

    <?php
    // Vérifier s'il y a des scores à afficher
    if (mysqli_num_rows($resultat) > 0) {
        ?>
        <table>
            <tr>
                <th>Nom du Quiz </th>
                <th>Score</th>
            </tr>
            <?php
            // Afficher les scores dans le tableau
            while ($row = mysqli_fetch_assoc($resultat)) {
                echo "<tr>";
                echo "<td>" . $row['nom_quiz'] . "</td>";
                echo "<td>" . $row['score'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <?php
    } else {
        echo "<p>Aucun score trouvé.</p>";
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
</body>
</html>
