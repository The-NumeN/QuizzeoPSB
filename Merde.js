function addquizz() {
    // Cette fonction permet de créer un bouton qui ouvre un formulaire de création de quizz
    for(i=1;i<=3;i++){
    var addquest = document.getElementById('crea').innerHTML;
    // au onclick on appelle une autre fonction qui ajoute des questions dans le quizz
    addquest = addquest + "Question"+ i +'<br></br><form><input type="text" id="id_question" placeholder="Intitulé"><br><input type="text" id="bonne_reponse" placeholder="Bonne réponse"><br><input type="text" id="reponse" placeholder="Mauvaise réponse"><br><input type="text" id="reponse" placeholder="Mauvaise réponse"><br></form>';
    document.getElementById('crea').innerHTML = addquest;}
}

// function modquestion() {
//     // ajout des questions
//     var question = document.getElementById('crea1').innerHTML;
//     question = question + '<br><br><input type=\"text\"/>';
//     document.getElementById('crea1').innerHTML = question;
// }
// function delquestion() {
// }
// function selectquizz() {
//     // var Select = document.getElementById('play').innerHTML;
//     // Select=
// }