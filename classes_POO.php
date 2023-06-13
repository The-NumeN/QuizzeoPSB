<?php
class utilisateur {
    private $pseudo;
    private $mail;
    private $password;
    private $role;

    public function __construct(){
        $this->pseudo=$ps;
        $this->mail=$mail;
        $this->password=$pwd;
        $this->role=$rl;
    }
}
class Quizz{
    private $titre;
    private $difficulte;
    private $date;

public function __construct(){
    $this->titre=$titre;
    $this->difficulte=$diff;
    $this->$date=$date;
}
}
class Question{
    private $intitule;
    private $difficulte;
    private $date;

public function __construct(){
    $this->intitule=$int;
    $this->diffficulte=$diff;
    $this->date=$date;
}
}
?>
