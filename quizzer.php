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
        <input type="button" onclick="addquestion()" value="Créer"/><br></br>
        <form>  
            <div id="crea"></div><br>
            <button type="submit">valider la question</button>
        </form> 
    <div id="crea"></div>
</body>
</html>