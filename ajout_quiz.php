<?php
    include 'header.php';
?>
<?php
session_start();
// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION["id_test"]) || !isset($_SESSION["pseudo"])) {
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
    
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION["id_test"])) {
        $id_test = $_SESSION["id_test"];
        $titre = $_POST["titre"];
        $difficulte = $_POST["difficulte"];
        $date_creation = date("Y-m-d");

        $quiz = new Quiz();
        $quizId = $quiz->insert_quizz($id_test, $titre, $difficulte, $date_creation);

        if ($quizId) {
            echo "Quiz inséré avec succès.";
        } else {
            echo "Erreur lors de l'insertion du quiz.";
        }
    } else {
        echo "Utilisateur non connecté.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un quiz</title>
    <link rel="stylesheet" href="connect2.css">
</head>
<body>
    <form method="post" action="">
        <input type="text" name="titre" id="titre" placeholder="Titre du quizz" required><br><br>

        <label for="difficulte">Difficulté:</label>
        <select name="difficulte" id="difficulte" required>
            <option value="1">Facile</option>
            <option value="2">Moyen</option>
            <option value="3">Difficile</option>
        </select><br><br>
        <input type="button" value="Ajouter une question" onclick="addquest()">
        <div id=crea></div>
        <input type="button" value="Supprimer une question" onclick="suppquest()">
        <div id=crea1></div>
        <input type="submit" value="Valider">
    </form>
    <script src="Merde.js"></script>
</body>
</html>