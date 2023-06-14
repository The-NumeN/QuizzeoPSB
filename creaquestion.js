function addquizz() {


    var addquest = document.getElementById('crea').innerHTML;
    addquest = addquest + '<input type="button"  onclick= "modquestion()" value = "ajouter une question"/>';
    document.getElementById('crea').innerHTML = addquest;

}
function modquestion() {
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