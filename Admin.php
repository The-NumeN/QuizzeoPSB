<?php
session_start();
// Vérifier si l'utilisateur est connecté en tant qu'admin, sinon rediriger vers la page de connexion
if (!isset($_SESSION["pseudo"]) || $_SESSION["role"] !== "admin") {
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
// Récupérer la liste des utilisateurs
$query = "SELECT * FROM Users";
$result = mysqli_query($connect, $query);
$users = [];

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion
    header("location: Connexion.php");
    exit();
}
//  connect list quizz
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
        <title>Administrateur</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="connect2.css">
    </head>
    <body>
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container-fluid">
                <a href="index.php"><img class="navbar-brand" src="img/logo-quiz-symboles-bulle-dialogue-concept-spectacle-questionnaire-chante-bouton-quiz-concours-questions-examen-embleme-moderne-interview_180786-72.avif" width="75" height="75" class="d-inline-block align-center" alt="Erreur"></a>
                <div class="navbar" id="navbarNav">
                    <ul class="navbar-nav">
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
        <br>
        <div class="container">
            <div class="border border-secondary rounded">
                <div class="card bg-light">
                    <div class="card-header">
                        <h3>Liste des utilisateurs</h3>
                    </div>
                    <div class="card-body">
                        <div class ="tableau">
                            <table>
                                <tr>
                                    <th>Nom d'utilisateur</th>
                                    <th>Rôle</th>
                                    <th>Actions</th>
                                </tr>
                                <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?php echo $user['pseudo']; ?></td>
                                    <td><?php echo $user['role']; ?></td>
                                    <td>
                                    <a href="edit_user.php?id_test=<?php echo $user['id_test']; ?>"><img src='img/edit.png' width='30px'></a></a>
                                    <?php if ($_SESSION["role"] === "admin" && $user['id_test'] !== $_SESSION["id_test"]) : ?>
                                        <a href="supp_user.php?id_test=<?php echo $user['id_test']; ?>"><img src='img/delete_user.png' width='30px'></a></a>
                                    <?php endif; ?>
                                    </td>
                                    </tr>
                                    <?php endforeach; ?>
                            </table>
                        </div>                 
                    </div>
                </div>
            </div>
            <br><br>
            <div class="border border-secondary  rounded">
                <div class="card bg-light">
                    <div class="card-header">
                        <h3>Liste des quizz</h3>
                    </div>
                    <div class="card-body">
                        <table> 
                            <tr>
                                <th>Titre</th>
                                <th>Difficulte</th>
                                <th>Actions</th>
                            </tr>
                            <?php foreach ($quizzes as $quiz) : ?>
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
                                    <a href="edit_quizz_ad.php?id_quizz=<?php echo $quiz['id_quizz']; ?>"><img class="ima" src='img/edit.png' width='30px'></a>
                                    <a href="supp_quizz.php?id_quizz=<?php echo $quiz['id_quizz']; ?>"><img class="ima" src='img/delete.png' width='30px'></a>
                                    <a href="jouer_quizz.php?id_quizz=<?php echo $quiz['id_quizz']; ?>"><button>Jouer</button></a><br>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
            <br><br>
                <a href="ajout_quiz.php"><button> Ajouter un quizz</button></a><br>
        </div><br><br><br>
        <footer class="fixed_footer">
            <div class="content">
                <p>&copy; - Stive Gamy  -  Babacar Gueye -  Paul Vicens </p>
            </div>
        </footer>
    </body>
</html>
