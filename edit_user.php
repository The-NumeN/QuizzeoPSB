<?php
session_start();
// Vérifier si l'utilisateur est connecté en tant qu'admin, sinon rediriger vers la page de connexion
if (!isset($_SESSION["pseudo"]) || $_SESSION["role"] !== "admin") {
    header("location: Connexion.php");
    exit();
}
// Deco
if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    session_destroy();
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
        <meta charset="UTF-8">
        <title>Modifier Pseudo</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <link rel="stylesheet" href="connectE.css">
=======
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="connect2.css">
>>>>>>> 533ecb908bc03558a016ddb7b9548d625080c067
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
                                <br><p class="bonjour">Bonjour <span><?php echo ucfirst($_SESSION["pseudo"]); ?></span></p>
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
        <br><br>
        <div class="container">
            <div class="border border-secondary rounded">
                <div class="card">
                    <div class="card-header">
                        <h1>Modifier Pseudo</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <label for="nouveau_pseudo">Nouveau Pseudo:</label>
                            <input type="text" name="nouveau_pseudo" value="<?php echo $pseudo; ?>" required>
                            <button type="submit">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="fixed_footer">
  <div class="content">
    <p>&copy; - Stive Gamy  -  Babacar Gueye -  Paul Vicens </p>
  </div>
</footer>
    </body>
    
</html>