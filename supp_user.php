<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'admin, sinon rediriger vers la page de connexion
if (!isset($_SESSION["pseudo"]) && $_SESSION["role"] !== "admin") {
    header("location: Connexion.php");
    exit();
}

if (isset($_GET["id_test"])) {
    $id = $_GET["id_test"];
    
    // Établir la connexion à la base de données
    $conn = mysqli_connect("127.0.0.1", "root", "", "quizzeo");

    // Mettre à jour la clé étrangère dans la table Quizzes pour l'attribuer à un autre utilisateur (administrateur)
    $updateQuery = "UPDATE Quizzes SET id_test = (SELECT id_test FROM Users WHERE role = 'admin') WHERE id_test = '$id'";
    mysqli_query($conn, $updateQuery);

    // Supprimer l'utilisateur de la table User_quizz
    $deleteQuery = "DELETE FROM User_quizz WHERE id_test = '$id'";
    mysqli_query($conn, $deleteQuery);

    // Supprimer l'utilisateur de la table Users
    $deleteQuery = "DELETE FROM Users WHERE id_test = '$id'";
    mysqli_query($conn, $deleteQuery);

    // Rediriger vers la page d'administration
    header("location: admin.php");
    exit();
}


?>
