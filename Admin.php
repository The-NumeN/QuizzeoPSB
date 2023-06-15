<?php
include 'header.php';
?>
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
        die("Échec de la connexion à la base de données: " .mysqli_connect_error());
    }
    return $conn;
}

// Vérifier si l'utilisateur est connecté en tant qu'admin, sinon rediriger vers la page de connexion
if (!isset($_SESSION["pseudo"]) || $_SESSION["role"] !== "admin") {
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


// Traitement des actions de suppression des utilisateurs
if (isset($_GET['action']) && $_GET['action'] === 'deleteUser' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    $conn = BDDconnect();
    $query = "DELETE FROM Users WHERE id_test = $userId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $message = "Utilisateur supprimé avec succès.";
    } else {
        $errorMessage = "Une erreur s'est produite lors de la suppression de l'utilisateur.";
    }
}
// Récupérer la liste des utilisateurs
$conn = BDDconnect();
$query = "SELECT * FROM Users";
$result = mysqli_query($conn, $query);
$users = [];

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrateur</title>

</head>
<body>
    <!-- + script de création/modification quizz & questions -->
<script src="creaquestion.js" type="text/javaScript"></script>

    <form action="admin.php" method="post">
        <input type="hidden" name="logout" value="true">
        <button type="submit">Déconnexion</button>
    </form>
    <h1>Bonjour <span><?php echo ucfirst($_SESSION["pseudo"]); ?></span> , Bienvenue !</h1><hr>
    
    <h3>Liste des utilisateurs</h3>
    <!-- création d'un tableau avec les données utilisateurs -->
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
                    <a href="edit_user.php?id=<?php echo $user['id_test']; ?>">Modifier</a>
                    <a href="?action=deleteUser&id=<?php echo $user['id_test']; ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<!-- Liste des quizz & création  de quizz-->
    <h3>Liste des quizz</h3>
    <a href="quizz_list.php">Voir la liste des quizz</a><br><br>
    <div class="jouer">
      <input type="button"onclick="selectquizz()"value="Jouer"/><br><br>
      <div id="play"></div>
    </div>

    <div class="créer">
    
        <input type="button" onclick="addquizz()" value="Créer un quizz"/><br></br>
    <div id="crea"></div>
    <div id="crea1"></div> 

    
</body>
<?php ?>
</html>
