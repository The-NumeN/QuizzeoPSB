<?php
session_start();

if (!isset($_SESSION["id_test"]) && !isset($_SESSION["pseudo"])) {
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
        <title>Modification des Quizzes</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="connect2.css">
    </head>
    <body>
        <!-- HEADER -->
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container-fluid">
            <!-- ajout du logo (retour au menu principal lorsque l'on clique dessus) -->
                <a href="index.php"><img class="navbar-brand" src="img/logo-quiz-symboles-bulle-dialogue-concept-spectacle-questionnaire-chante-bouton-quiz-concours-questions-examen-embleme-moderne-interview_180786-72.avif" width="75" height="75" class="d-inline-block align-top" alt="Erreur"></a>
                <div class="navbar" id="navbarNav">
                    <ul class="navbar-nav  ">
            <!-- ajout des liens de redirection -->
                        <div class="inscri">
                            <li class="nav-item">
                                <br><p class="bonjour">Bonjour <span><?php echo ucfirst($_SESSION["pseudo"]); ?></span>, Bienvenue !</p>
                            </li>
                        </div>
                        <div class="conn">
                            <li class="nav-item">
                                <form action="" method="post">
                                    <input type="hidden" name="logout" value="true">
                                    <button type="submit">Déconnexion</button>
                                </form>
                            </li>
                        </div>
                        <div class="deco">
                            <li class="nav-item">
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    <h2>Liste des quizz</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th>Difficulte</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($quizzes as $quiz) : ?>
            <tr>
                <td><?php echo $quiz['titre']; ?></td>
                <td><?php echo $quiz['difficulte']; ?></td>
                <td>
                    <a href="modif_quizz.php?id_quizz=<?php echo $quiz['id_quizz']; ?>">Modifier</a>
                    <a href="supp_quizz.php?id_quizz=<?php echo $quiz['id_quizz']; ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
