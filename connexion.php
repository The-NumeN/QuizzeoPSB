<?php
include 'header.php';
session_start();
// On récupère les valeurs saisies
if(isset($_POST["button"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    // On se connecte à la base de donnée 
    $connect_bdd = mysqli_connect("127.0.0.1","root","","quizzeo");

    // On lance la requête de récupération des valeurs saisies
    $req = "SELECT * FROM Users WHERE pseudo = '$username' AND password = '$password'";
    $res = mysqli_query($connect_bdd, $req);
    
    // On fait une condition au cas où les données saisies sont correctes ou fausses
    if(mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
        $_SESSION["username"] = $username;
        // Vérification du rôle admin
        if ($row["role"] == "admin") {
            $_SESSION["role"] = "admin";
            header("location: admin.php");
        }
        // Vérification du rôle quizzer
        elseif ($row["role"] == "quizzer") {
            $_SESSION["role"] = "quizzer";
            header("location: quizzer.php");
        }
        // Redirection vers la page utilisateur par défaut
        else {
            header("location: user.php");
        }
    } else {
        echo "Erreur";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Connexion.css">
    <title>Connexion</title>
</head>
<body>
    <div>
    <form action="" method="post">
        <h1>Connexion</h1><hr>
        <label>Pseudo</label><br>
        <input type="text" name="username" required  ><br><br>
        <label>Mot de passe</label><br>
        <input type="password" name="password" required ><br><br>
        <button type="submit" name="button">Se connecter</button>
    </form>
    </div>
</body>
</html>
