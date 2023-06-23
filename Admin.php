<?php
session_start();
// Vérifier si l'utilisateur est connecté en tant qu'admin, sinon rediriger vers la page de connexion
if (!isset($_SESSION["pseudo"]) && $_SESSION["role"] !== "admin") {
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrateur</title>
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark">
      <div class="container-fluid">
      <!-- ajout du logo (retour au menu principal lorsque l'on clique dessus) -->
        <a href="index.php"><img class="navbar-brand" src="img/logo-quiz-symboles-bulle-dialogue-concept-spectacle-questionnaire-chante-bouton-quiz-concours-questions-examen-embleme-moderne-interview_180786-72.avif" width="75" height="75" class="d-inline-block align-top" alt="Erreur"></a>
        
        <div class="navbar" id="navbarNav">
          <ul class="navbar-nav  ">
          <!-- ajout des liens de redirection -->
          <div class="inscri">
            <li class="nav-item">
              <a id="inscri"class="nav-link" href="inscription.php">Inscription</a>
            </li>
          </div>
          <div class="conn">
            <li class="nav-item">
              <a id="conn" class="nav-link" href="connexion.php">Connexion</a>
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
    <br>
    <form action="admin.php" method="post">
        <input type="hidden" name="logout" value="true">
        <button type="submit">Déconnexion</button>
    </form>
    <h1>Bonjour <span><?php echo ucfirst($_SESSION["pseudo"]); ?></span> , Bienvenue !</h1><hr>
    
    <h3>Liste des utilisateurs</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['id_test']; ?></td>
                <td><?php echo $user['pseudo']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td>
                    <a href="edit_user.php?id_test=<?php echo $user['id_test']; ?>">Modifier</a>
                    <?php if ($_SESSION["role"] !== "admin" && $user['id_test'] !== $_SESSION["id_test"]) : ?>
                        <a href="supp_user.php?id_test=<?php echo $user['id_test']; ?>">Supprimer</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h3>Liste des quizz</h3>
    <a href="list_quiz.php">Voir la liste des quizz</a>

    <h3>Ajouter un quizz</h3>
    <a href="ajout_quiz.php">Ajouter un quizz</a>

    <h3>Quizz créés par le quizzeur</h3>
    <a href="user_quizzes.php">Voir les quizz créés par le quizzeur</a>
</body>
</html>
