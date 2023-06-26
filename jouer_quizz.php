<?php
session_start();
$connect_bdd = mysqli_connect("127.0.0.1", "root", "", "quizzeo");
$stp=$_GET['id_quizz'];
$test="SELECT * FROM questions where id_quizz='$stp'";
$result = mysqli_query($connect_bdd, $test);
$question = [];
while ($row = mysqli_fetch_assoc($result)) {
    $question[] = $row;
  }
?>
<h2>Liste des questions</h2>
    <table>
        <?php foreach ($question as $quest) : ?>
            <tr>
                <td><?php echo $quest['intitule']; ?></td>
                    
                
            </tr>
        <?php endforeach; ?>
</table>