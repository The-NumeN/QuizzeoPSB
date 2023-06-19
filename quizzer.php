<?php
    include 'header.php';
?>
<?php
session_start();

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
    <title>Quizzer</title>
    <link rel="stylesheet" href="connect2.css">
</head>
<body>
    <form action="admin.php" method="post">
        <input type="hidden" name="logout" value="true">
        <button type="submit">Déconnexion</button>
    </form>
    <h1>Bonjour <span><?php echo ucfirst($_SESSION["pseudo"]); ?></span> , Bienvenue !</h1><hr>

    <h3>Liste des quizz</h3>
    <a href="quizz_list.php">Voir la liste des quizz</a>

    <h3>Ajouter un quizz</h3>
    <a href="ajout_quiz.php">Ajouter un quizz</a>

    <h3>Quizz créés par le quizzeur</h3>
    <a href="user_quizzes.php">Voir les quizz créés par le quizzeur</a>
</body>
<?php ?>
</html>