function addquizz() {
    // Cette fonction permet de créer un bouton qui ouvre un formulaire de création de quizz

    var addquest = document.getElementById('crea').innerHTML;
    // au onclick on appelle une autre fonction qui ajoute des questions dans le quizz
    addquest = addquest + '<br>br><input type="button"  onclick= "modquestion()" value = "ajouter une question"/>';
    document.getElementById('crea').innerHTML = addquest;

}

function modquestion() {
    // ajout des questions
    var question = document.getElementById('crea1').innerHTML;
    question = question + '<br><br><input type=\"text\"/>';
    document.getElementById('crea1').innerHTML = question;
}
function delquestion() {
}
function selectquizz() {
    // var Select = document.getElementById('play').innerHTML;
    // Select=
}