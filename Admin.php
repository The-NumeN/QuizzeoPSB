<?php
session_start();

// Fonction pour établir une connexion à la base de données
function BDDconnect() {
    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "quizzeo";

    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Échec de la connexion à la base de données: ");
    }
    return $conn;
}
// Vérifier si l'utilisateur est connecté en tant qu'admin, sinon rediriger vers la page de connexion
if (!isset($_SESSION["pseudo"]) && $_SESSION["role"] !== "admin") {
    header("location: Connexion.php");
    exit();
}

// Établir la connexion à la base de données
$conn = BDDconnect();

// Récupérer la liste des utilisateurs
$query = "SELECT * FROM Users";
$result = mysqli_query($conn, $query);
$users = [];

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}
?>
<?php 
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrateur</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="connect2.css">
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
        <h3>Liste des utilisateurs</h3><br><br>
    <!-- création d'un tableau avec les données utilisateurs -->
        
        <div class ="tableau">
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
                        <a href="">Modifier</a>
                        <a href="">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div><br><br>
<!-- Liste des quizz & création  de quizz-->
<h3>Liste des quizz</h3>
    <a href="list_quiz.php">Voir la liste des quizz</a><br><br>

    <h3>Ajouter un quizz</h3>
    <a href="ajout_quiz.php">Ajouter un quizz</a><br> <br>

    <h3>Quizz créés par le quizzeur</h3>
    <a href="user_quizzes.php">Voir les quizz créés par le quizzeur</a>
    </body>
</html>
