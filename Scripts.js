var ident = 1;
function addquest() {
    // Cette fonction permet de créer un bouton qui ouvre un formulaire de création de quizz
    const ajou = document.querySelectorAll('.id_question');
    for (var ide = 1; ide <= ajou.lenght; ide++) {
        ident = ide;
    }
    ident++
    var addquest = document.getElementById('crea').innerHTML;
    // au onclick on appelle une autre fonction qui ajoute des questions dans le quizz
    addquest = addquest   +'<div id="id_question" name="id_question"><br><form method="post"><input type="text" id="intitule'+ident+' name="intitule"placeholder="Intitulé"><br><input type="text" name="bonne_reponse'+ident+'" placeholder="Bonne réponse"><br><input type="text" id="reponse1-'+ident+'" placeholder="Mauvaise réponse "><br><input type="text" id="reponse2-'+ident+'" placeholder="Mauvaise réponse"><br></form></div> ';
    document.getElementById('crea').innerHTML = addquest;
}
function suppquest() {
    const element = document.getElementById("id_question");
    element.remove();
}