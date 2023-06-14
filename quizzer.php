<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizzer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="creaquestion.js" type="text/javaScript">
    </script>
    <script></script>
    <script></script>
</head>
<body>
<script>
</script>
    <div class="jouer">
        <h2>Jouer</h2>
        <p>Choisis un quizz</p>
    <!-- BOUTONS QUIZZ -->
        <div class="categories" >
            <ol>
                <li>
                    <button id=""name="th1">Musique<a href=""></a></button><br><br>
                </li>
                <li>
                    <button id=""name="th2">Cinema<a href=""></a></button><br><br>
                </li>
                <li>
                    <button id=""name="th3">Foot<a href=""></a></button><br><br>
                </li>
            </ol>
        </div>
    </div>
    <div class="créer">
    <input type="button" onclick="addquestion()" value="Créer"/><br></br>
    <div id="crea"></div>
    </div>
</body>
</html>