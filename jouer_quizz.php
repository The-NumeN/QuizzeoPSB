<?php
session_start();
$connect_bdd = mysqli_connect("127.0.0.1", "root", "", "quizzeo");
$stp = $_GET['id_quizz'];

// Sélection des questions
$test = "SELECT * FROM questions WHERE id_quizz='$stp'";
$result = mysqli_query($connect_bdd, $test);

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="connect2.css">
</head>

<div class="cuicuiz">
    <div class="liquest">
        <h2>Liste des questions</h2>
    </div>
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            // Parcourir les questions
            while ($row = $result->fetch_assoc()) {
                $questionId = $row['id_question'];
                $questionText = $row['intitule'];

                // Sélection des réponses pour la question actuelle
                $sql = "SELECT * FROM choices WHERE id_question='$questionId'";
                $resulte = mysqli_query($connect_bdd, $sql);
                ?>
                <div class="card bg-light">
                    <div class="card-header">
                        <?php echo $questionText; ?>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($resulte->num_rows > 0) {
                            // Parcourir les réponses de la question actuelle
                            while ($row = $resulte->fetch_assoc()) {
                                echo $row["bonne_reponse"] . "<br>" . $row["reponse"] . "<br>" . $row["reponce"] . "<br>" . $row["reponze"];
                            }
                        } else {
                            echo "Aucune réponse trouvée.";
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "Aucune question trouvée.";
        }
        ?>
    </div>
</div>

</html>
