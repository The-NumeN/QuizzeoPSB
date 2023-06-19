function addquest() {
    // Cette fonction permet de créer un bouton qui ouvre un formulaire de création de quizz    
    var addquest = document.getElementById('crea').innerHTML;
    // au onclick on appelle une autre fonction qui ajoute des questions dans le quizz
    addquest = addquest   +'<br></br><form><input type="text" id="id_question" placeholder="Intitulé"><br><input type="text" id="bonne_reponse" placeholder="Bonne réponse"><br><input type="text" id="reponse" placeholder="Mauvaise réponse"><br><input type="text" id="reponse" placeholder="Mauvaise réponse"><br></form> ';
    document.getElementById('crea').innerHTML = addquest;
}
function suppquest(){
    var suppquest=document.getElementById('crea1').innerHTML;
    suppquest=delete addquest;
}