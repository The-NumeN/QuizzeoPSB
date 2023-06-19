
function addquest() {
    // Cette fonction permet de créer un bouton qui ouvre un formulaire de création de quizz    
    var addquest = document.getElementById('crea').innerHTML;
    // au onclick on appelle une autre fonction qui ajoute des questions dans le quizz
    addquest = addquest + '<br></br><form><input type="text" id="id_question" placeholder="Intitulé"><br><input type="text" id="bonne_reponse" placeholder="Bonne réponse"><br><input type="text" id="reponse" placeholder="Mauvaise réponse"><br><input type="text" id="reponse" placeholder="Mauvaise réponse"><br></form> ';
    document.getElementById('crea').innerHTML = addquest;
}
function suppquest() {
    var suppquest = document.getElementById('crea1').innerHTML;
    suppquest = delete addquest;
    function addquizz() {
        // Cette fonction permet de créer un bouton qui ouvre un formulaire de création de quizz
        for (i = 1; i <= 3; i++) {
            var addquest = document.getElementById('crea').innerHTML;
            // au onclick on appelle une autre fonction qui ajoute des questions dans le quizz
            addquest = addquest + "Question" + i + '<br><form><input type="text" id="id_question" placeholder="Intitulé"><br><input type="text" id="bonne_reponse" placeholder="Bonne réponse"><br><input type="text" id="reponse" placeholder="Mauvaise réponse"><br><input type="text" id="reponse" placeholder="Mauvaise réponse"><br><br></form>';
            document.getElementById('crea').innerHTML = addquest;
        }
    }
}

// Fonctions pour cacher les boutons de la barnav
function hide_deco() {
    var cache = document.getElementById("deco");
    cache.classList.add("deco");
}
function hide_conn() {
    var cache1 = document.getElementById("conn");
    cache1.classList.add("conn");
}
function hide_inscr() {
    var cache2 = document.getElementById("inscri");
    cache2.classList.add("inscri");
}