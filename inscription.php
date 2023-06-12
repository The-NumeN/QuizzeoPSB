<?php
    session_start();
    $connect_bdd= mysqli_connect("127.0.0.1","root","","quizzeo");
    //On recupère les valeurs entrées dans notre formulaire et on les remplaces par des varibales
    if(isset($_POST['submit']))// On fais la condition du <<si il appuie sur le button d'envoi >>
    {
        $email= $_POST['txt'];
        $mdp= $_POST['pwd'];
        $pseudo= $_POST['ps'];
        //On fais une réquête d'insersion des valeurs recupérés dans la base de donnée
        $req= "insert into users (email,password,pseudo)
        values ('$email','$mdp','$pseudo')";
        mysqli_query($connect_bdd,$req);

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="Quizz.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"> 
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <div class="container fluid text-center">
        <a class="navbar-brand" href="#">
            <img src="img/logo-quiz-symboles-bulle-dialogue-concept-spectacle-questionnaire-chante-bouton-quiz-concours-questions-examen-embleme-moderne-interview_180786-72.avif" width="70" height="70" class="d-inline-block align-top" alt="Erreur">
        </a>
    </div>
    <form action="user.php" method="post"> 
        <label for="Utilisateur">Pseudo</label>
        <input type="text" name="ps" placeholder="Entrer un Pseudo" required><br><br>
        <label for="mail">Adresse mail:</label>
        <input type="email" name="txt" placeholder="Votre email" required><br><br>
        <label for="mot de passe">Mot de passe:</label>
        <input type="password" name="pwd" placeholder="Votre mot de passe" required><br><br>
        <button type="submit" name="submit" >Inscription</button>
    </form>
</body>
</html>