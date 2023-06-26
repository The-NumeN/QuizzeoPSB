<?php
session_start();
$connect_bdd = mysqli_connect("127.0.0.1", "root", "", "quizzeo");
$stp=$_GET['id_quizz'];
$test="SELECT * FROM questions where id_quizz='$stp'";
$sql = "SELECT bonne_reponse, reponse,reponce ,reponze FROM choices";
$result = mysqli_query($connect_bdd, $test);
$resulte = mysqli_query($connect_bdd, $sql);
?>
<h2>Liste des questions</h2>
<?php 
   if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
      echo  $row['intitule']."<br>";
    }
  } else {
    echo "0 results";
  }
  if ($resulte->num_rows > 0) {
    // output data of each row
    while($row = $resulte->fetch_assoc()) {
        
      echo  $row["bonne_reponse"]."<br>". $row["reponse"]."<br>". $row["reponce"]."<br>".$row["reponze"];
    }
  } else {
    echo "0 results";
  }
  ?>