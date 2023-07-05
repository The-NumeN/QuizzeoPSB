<?php
    include "header.php";
    ?>
<?php
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
        $_SESSION["id_test"] = $id_test;

        if ($role == 'quizzer') {
            header("location: connexion.php");
        } else {
            header("location: connexion.php");
        }
    }
}
?>
<!DOCTYPE html>
<!-- formulaire d'inscription -->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> 
        <link rel="stylesheet" href="connect2.css">

    </head>
    <body>
    <style>
            body{
             background-image:url();
            }
        </style>
        <div class ="container">
            <br><br>
            <div class="border border-secondary w-50 mx-auto rounded">
                <div class="card bg-light">
                    <form action="" method="post">
                        <div class="card-header">
                            <h1>Inscription</h1>
                        </div> <br>
                        <div class="card-body">
                            <input type="text" name="ps" placeholder="Entrer un Pseudo" required><br><br>
                            <input type="email" name="txt" placeholder="Votre email" required><br><br>
                            <input type="password" name="pwd" placeholder="Votre mot de passe" required><br><br>
                            <input type="radio" name="user_type" value="quizzer" required> Quizzer (Crée des quizz)<br>
                            <input type="radio" name="user_type" value="utilisateur" required> Utilisateur<br><br>
                            <button type="submit" name="submit">Inscription</button>
                        </div>
                    </form>
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