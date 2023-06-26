<?php
session_start();
$connect_bdd = mysqli_connect("127.0.0.1", "root", "", "quizzeo");
$test="SELECT * FROM questions";
$result = mysqli_query($connect_bdd, $test);
$question = [];
while ($row = mysqli_fetch_assoc($result)) {
    $question[] = $row;
  }
?>
<h2>Liste des questions</h2>
    <table>
        <?php foreach ($question as $quiz) : ?>
            <tr>
                <td><?php echo $quiz['intitule']; ?></td>
                    
                </td>
            </tr>
        <?php endforeach; ?>
</table>