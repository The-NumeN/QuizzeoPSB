<?php
    include 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Quizzer</title>
    <link rel="stylesheet" href="connect2.css">
</head>
<body>
    <h1>Bonjour <span><?php echo ucfirst($_SESSION["pseudo"]); ?></span> , Bienvenue !</h1><hr>

    <h3>Liste des quizz</h3>
    <a href="quizz_list.php">Voir la liste des quizz</a> <br><br>

    <h3>Ajouter un quizz</h3>
    <a href="ajout_quiz.php">Ajouter un quizz</a><br><br>

    <h3>Quizz créés par le quizzeur</h3>
    <a href="user_quizzes.php">Voir les quizz créés par le quizzeur</a>
</body>
<?php ?>
</html>