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
    <script src="creaquestion.js"></script>
    <a href="Connexion.php">Deconnexion</a>
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
                    <a href="edit_user.php?id=<?php echo $user['id_test']; ?>">Modifier</a>
                    <a href="?action=deleteUser&id=<?php echo $user['id_test']; ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Liste des quizz</h3>
    <a href="quizz_list.php">Voir la liste des quizz</a>
    <h3>Créer un quizz</h3>
    <div class="créer">
        <input type="button" onclick="addquizz()" value="Créer"/><br></br>
        <form>  
            <div id="crea"></div><br>
            <button type="submit">valider la question</button>
        </form> 
    <h3>Quizz créés par le quizzeur</h3>
    <a href="user_quizzes.php">Voir les quizz créés par le quizzeur</a>
</body>
<?php ?>
</html>
