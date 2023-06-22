<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'admin, sinon rediriger vers la page de connexion
if (!isset($_SESSION["pseudo"]) || $_SESSION["role"] !== "admin") {
    header("location: Connexion.php");
    exit();
}

if (isset($_GET["id_test"])) {
    $id = $_GET["id_test"];
    // Établir la connexion à la base de données
    $connect_bdd =  mysqli_connect("127.0.0.1","root","","quizzeo");
    // Récupérer le pseudo de l'utilisateur
    $query = "SELECT pseudo FROM Users WHERE id_test = '$id'";
    $result = mysqli_query($connect_bdd, $query);
    $row = mysqli_fetch_assoc($result);
    $pseudo = $row['pseudo'];

    if (isset($_POST["nouveau_pseudo"])) {
        $nouveauPseudo = $_POST["nouveau_pseudo"];
        // Mettre à jour le pseudo de l'utilisateur avec le nouveau pseudo saisi
        $req = "UPDATE Users SET pseudo = '$nouveauPseudo' WHERE id_test = '$id'";
        mysqli_query($connect_bdd, $req);
        // Rediriger vers la page d'administration
        header("location: admin.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier Pseudo</title>
</head>
<body>
    <h1>Modifier Pseudo</h1>
    <form action="" method="post">
        <label for="nouveau_pseudo">Nouveau Pseudo:</label>
        <input type="text" name="nouveau_pseudo" required>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>