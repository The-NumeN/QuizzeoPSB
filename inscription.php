<?php
    include "header.php";
    ?>
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
        $req= "select * from users where pseudo = '$pseudo'  mdp = '$mdp'";
        $res= mysqli_query($connect_bdd,$req );

            $_SESSION["pseudo"] = $pseudo;
        header("location:user.php"); 
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
    <form action="" method="post"> 
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