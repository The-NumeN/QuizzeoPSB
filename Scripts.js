var ident=1; 
function addquest() {
    // Cette fonction permet de créer un bouton qui ouvre un formulaire de création de quizz
    const ajou=document.querySelectorAll('.gta');   
    for(var ide=1;ide<=ajou.lenght;ide++){
        ident=ide;
    }
    ident++
    var addquest = document.getElementById('crea').innerHTML;
    // au onclick on appelle une autre fonction qui ajoute des questions dans le quizz
    addquest = addquest   +'<br></br><div=gta><form><input type="text" id="id_question'+ident+'" placeholder="Intitulé"><br><input type="text" id="bonne_reponse'+ident+'" placeholder="Bonne réponse"><br><input type="text" id="reponse1-'+ident+'" placeholder="Mauvaise réponse "><br><input type="text" id="reponse2-'+ident+'" placeholder="Mauvaise réponse"><br></form></div> ';
    document.getElementById('crea').innerHTML = addquest;
}
function suppquest(){
    var suppquest= document.getElementById('crea1').innerHTML;
    var supp=document.getElementsByTagName('form');
    suppquest= delete(supp);
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