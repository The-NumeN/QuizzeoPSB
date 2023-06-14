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
      <input type="button"onclick="selectquizz()"value="Jouer"/><br><br>
      <div id="play"></div>
    </div>
    <div class="créer">
    <div class="créer">
        <input type="button" onclick="addquizz()" value="Créer"/><br></br>
        <form>
            <div id="crea">
              <label for="Quizz">Nouveau quizz</label><br>
              <label for="titre_quizz">Titre du quizz</label><br>
              <input type="text"id="ttquizz"><br>
              <label for="difficulte">Difficulté du quizz</label><br>
              <select id="diff" name="diff"><br>
                <option value="d0"> selectionnez une difficulté</option>
                <option value="d1">1</option>
                <option value="d2">2</option>
                <option value="d3">3</option>
              </select><br>
              <div id="crea1">
                <label for="Question">Nouvelle question</label><br>
                <label for="titre_question">Titre de la question</label><br>
                <input type="text"id="ttquestion"><br>
                <label for="difficulte">Difficulté de la question</label><br>
                <select id="diff1" name="diff1"><br>
                <option value="d10"> selectionnez une difficulté</option>
                <option value="d11">1</option>
                <option value="d12">2</option>
                <option value="d13">3</option>
                <label for="nquest">La question</label>
                <input type="text"id="thequest">
              </select><br>
              </div>
            </div><br>
            <button type="submit">créer le quizz</button>
        </form> 
    <div id="crea"></div>
</body>
</html>