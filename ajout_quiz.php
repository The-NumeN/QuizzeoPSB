<?php
session_start();
// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION["id_test"]) || !isset($_SESSION["pseudo"]) || ($_SESSION["role"] !== "quizzer" && $_SESSION["role"] !== "admin")) {
    header("location: Connexion.php");
    exit();
}

if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion
    header("location: Connexion.php");
    exit();
}

class Quiz {
    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "quizzeo";
    private $connect;

    public function __construct()
    {
        $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if ($this->connect->connect_error) {
            echo "Échec de la connexion à la base de données: " . $this->connect->connect_error;
        }
    }

    public function insert_quizz($id_test, $titre, $difficulte, $date_creation) {
        $id_test = (int) $id_test;
        $titre = mysqli_real_escape_string($this->connect, $titre);
        $difficulte = (int) $difficulte;
        $date_creation = mysqli_real_escape_string($this->connect, $date_creation);        
    
        $insert = "INSERT INTO quizzes (id_test, titre, difficulte, date_creation) VALUES ($id_test, '$titre', $difficulte, '$date_creation')";
    
        return mysqli_query($this->connect, $insert) ? mysqli_insert_id($this->connect) : false;
    }
    public function insert_quest($id_quizz,$intitule,$date_creation) {
        $id_quizz = (int) $id_quizz;
        $intitule = mysqli_real_escape_string($this->connect, $intitule);
        $date_creation = mysqli_real_escape_string($this->connect, $date_creation);        
    
        $insert = "INSERT INTO questions (id_quizz, intitule, date_creation) VALUES ($id_quizz,'$intitule','$date_creation')";
    
        return mysqli_query($this->connect, $insert) ? mysqli_insert_id($this->connect) : false;
    }
    public function insert_choice($id_question,$bonne_reponse,$reponse,$reponce,$reponze) {
        $id_question = (int) $id_question;
        $bonne_reponse = mysqli_real_escape_string($this->connect, $bonne_reponse);
        $reponse = mysqli_real_escape_string($this->connect, $reponse); 
        $reponce = mysqli_real_escape_string($this->connect, $reponce);  
        $reponze = mysqli_real_escape_string($this->connect, $reponze);         
        $insert = "INSERT INTO choices (id_question,bonne_reponse,reponse,reponce,reponze) VALUES ($id_question,'$bonne_reponse','$reponse','$reponce','$reponze')";
        return mysqli_query($this->connect, $insert) ? mysqli_insert_id($this->connect) : false;
    }
    
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_SESSION["id_test"])) {
        $id_test = $_SESSION["id_test"];
        $titre = $_POST["titre"];
        $difficulte = $_POST["difficulte"];
        $date_creation = date("Y-m-d");
        
        $quizz = new Quiz();
        $quizz_id = $quizz->insert_quizz($id_test, $titre, $difficulte, $date_creation);
        if ($quizz_id) {
            $ident = $_POST["ident"];
            for ($i = 1; $i <= $ident; $i++) {
                $intitule = $_POST["intitule$i"];
                $question_id = $quizz->insert_quest($quizz_id, $intitule, $date_creation);
                if (!$question_id) {
                    echo "Erreur lors de l'insertion de la question $i.";
                } else {
                    $bonne_reponse = $_POST["bonne_reponse$i"];
                    $reponse = $_POST["reponse1-$i"];
                    $reponce = $_POST["reponse2-$i"];
                    $reponze = $_POST["reponse3-$i"];
                    $choice_id = $quizz->insert_choice($question_id, $bonne_reponse, $reponse, $reponce, $reponze);
                    if (!$choice_id) {
                        echo "Erreur lors de l'insertion des choix pour la question $i.";
                    }
                }
            }
            echo "Quiz inséré avec succès.";
        } else {
            echo "Erreur lors de l'insertion du quiz.";
        }
    }        
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajout Quiz</title>
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
                <a href="index.php"><img class="navbar-brand" src="img/logo-quiz-symboles-bulle-dialogue-concept-spectacle-questionnaire-chante-bouton-quiz-concours-questions-examen-embleme-moderne-interview_180786-72.avif" width="75" height="75" class="d-inline-block align-center" alt="Erreur"></a>
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
                <div class="card bg-light">
                    <form method="post" action="" name="monform">
                        <div class="card-header">
                            <h3>Crées ton Quizz</h3><br>
                        </div>
                        <div class="card-body">
                            <input type="text" name="titre" id="titre" placeholder="Titre du quizz" required><br><br>
                            <label for="difficulte">Difficulté:</label>
                            <select name="difficulte" id="difficulte" required>
                                <option value="1">Facile</option>
                                <option value="2">Moyen</option>
                                <option value="3">Difficile</option>
                            </select><br><br> 
                        <input type="button" value="Ajouter une question" onclick="addquest()">
                            <div id=crea></div><br><br>
                            <input type="button" value="Supprimer une question" onclick="suppquest()">
                            <div id=crea1></div><br>
                        </div>
                        <button type="submit" name="submit" id="submit">Valider</button>
                    </form>      
                </div>
            </div>
        </div><br><br><br>
        <footer class="fixed_footer">
  <div class="content">
    <p>&copy; - Stive Gamy  -  Babacar Gueye -  Paul Vicens </p>
  </div>
</footer>
        <script src="ScriptS.js"></script>
    </body>
</html>