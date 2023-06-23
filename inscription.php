<?php
    include "header.php";
    ?>
<?php
session_start();
$connect_bdd = mysqli_connect("127.0.0.1", "root", "", "quizzeo");

if (isset($_POST['submit'])) {
    $email = $_POST['txt'];
    $mdp = sha1($_POST['pwd']);
    $pseudo = $_POST['ps'];
    $role = $_POST['user_type'];

    // Vérifier si l'adresse e-mail existe déjà
    $check_mail_q = "SELECT * FROM users WHERE email = '$email'";
    $check_mail_res = mysqli_query($connect_bdd, $check_mail_q);
    if (mysqli_num_rows($check_mail_res) > 0) {
        echo "Mail est déjà utilisée";
    } else {
        // Insérer l'utilisateur dans la base de données
        $insert_query = "INSERT INTO users (pseudo, email, password, role) VALUES ('$pseudo', '$email', '$mdp', '$role')";
        mysqli_query($connect_bdd, $insert_query);

        $_SESSION["pseudo"] = $pseudo;

        if ($role == 'quizzer') {
            header("location: quizzer.php");
        } else {
            header("location: user.php");
        }
    }
}
?>
<!DOCTYPE html>
<!-- formulaire d'inscription -->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"> 
        <link rel="stylesheet" href="connect2.css">
    </head>
    <body>
        <div class ="container">
            <div class="card bg-light">
                <form action="" method="post">
                    <div class="card-header">
                        <h1>Inscription</h1>
                    </div> <br>
                    <div class="card-body">
                        <label for="Utilisateur">Pseudo</label>
                        <input type="text" name="ps" placeholder="Entrer un Pseudo" required><br><br>
                        <label for="mail">Adresse mail:</label>
                        <input type="email" name="txt" placeholder="Votre email" required><br><br>
                        <label for="mot de passe">Mot de passe:</label>
                        <input type="password" name="pwd" placeholder="Votre mot de passe" required><br><br>

                        <label for="user_type">Choisissez votre rôle:</label><br>
                        <input type="radio" name="user_type" value="quizzer" required> Quizzer<br>
                        <input type="radio" name="user_type" value="utilisateur" required> Utilisateur<br><br>

                        <button type="submit" name="submit">Inscription</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>