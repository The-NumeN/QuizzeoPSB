<?php
include "header.php";
session_start();
$connect_bdd = mysqli_connect("127.0.0.1", "root", "", "quizzeo");
$stp=$_GET['id_quizz'];
$test="SELECT intitule FROM questions where id_quizz='$stp'";
$sql = "SELECT bonne_reponse, reponse,reponce ,reponze FROM choices";
$result = mysqli_query($connect_bdd, $test);
$resulte = mysqli_query($connect_bdd, $sql);
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
  <div class="liquest"><h2>Liste des questions</h2></div>
    <div class="container">
      <div class="card bg-light">
        <div class="card-header">
        <!-- c'est le titre de la question -->
          <?php 
            if ($result->num_rows > 0) {
    // output data of each row
              while($row = $result->fetch_assoc()) {
                while($row = $resulte->fetch_assoc()) {
                  echo  $row['intitule']."<br>"; 
                  echo  $row["bonne_reponse"]."<br>". $row["reponse"]."<br>". $row["reponce"]."<br>".$row["reponze"]."<br>";
                }
              }
            } else {
                echo "0 results";
              }
          ?>
        </div>
        </div>
      </div>
    </div>
  </div>
</html>