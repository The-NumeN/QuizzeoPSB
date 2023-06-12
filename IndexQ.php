<?php
    session_start();
    $connect_bdd= mysqli_connect("127.0.0.1","root","","services");
    //On recupère les valeurs entrées dans notre formulaire et on les remplaces par des varibales
    if(isset($_POST['submit']))// On fais la condition du <<si il appuie sur le button d'envoi >>
    {
        $nom= $_POST['nom'];
        $prenom= $_POST['prenom'];
        $email= $_POST['email'];
        $mdp= $_POST['mdp'];
        $pseudo= $_POST['pseudo'];
        //On fais une réquête d'insersion des valeurs recupérés dans la base de donnée
        $req= "insert into travailleurs values (null, '$nom','$prenom', '$email', '$mdp', '$pseudo' )";
        mysqli_query($connect_bdd,$req);
        // On fais une réquête d'affichage uniquement des pseudo et mot de passe existant dans la base de donnée
        $req= "select * from travailleurs where pseudo = '$pseudo' and mdp= '$mdp'";
        $res= mysqli_query($connect_bdd,$req );
        
            $_SESSION["pseudo"] = $pseudo;
            header("location:Tache/Tache.php");
    
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="Quizz.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" c> 
</head>
<body>
    <nav class="navbar navbar-dark bg-success">
        <a class="navbar-brand" href="#">
            <img src="img/logo-quiz-symboles-bulle-dialogue-concept-spectacle-questionnaire-chante-bouton-quiz-concours-questions-examen-embleme-moderne-interview_180786-72.avif" width="70" height="70" class="d-inline-block align-top" alt="Erreur">
        </a>
    </nav>
    <form> 
        <label for="Utilisateur">Pseudo</label>
        <input type="text" id="ps" placeholder="Entrer un Pseudo" required><br><br>
        <label for="adresse">Adresse mail:</label>
        <input type="email" id="txt" placeholder="Votre email" required><br><br>
        <label for="adresse">Mot de passe:</label>
        <input type="password" id="pwd" placeholder="Votre mot de passe" required>
        <input type="submit" value="Soumettre">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"></script>
</body>
</html>