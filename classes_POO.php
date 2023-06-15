<?php
// Création de la class Quizz
    class Quizz{
        private $host="127.0.0.1";
        private $username="root";
        private $password="";
        private $database="quizzeo";
        private $titre;
        private $difficulte;
        private $date;

        public function __construct(){
    
            $this->host=$host;
            $this->username=$username;
            $this->password=$pwd;
            $this->database=$bdd;
            $this->titre=$titre;
            $this->difficulte=$diff;
            $this->$date=$date;
// Connexion du quizz à la BDD
            {
                $this->conn = msqli_connect($this->host,$this->username,$this->password,$this->database);
                if($this->conn->connect_error){
                    echo "Echec de la connexion à la base de données:".$this->conn->connect_error;
                }
            }
// Insertion des quizz dans la BDD
        }
        public function set_quizz(){
        
        }

    }
// Création de la class Question
    class Question{
        private $host="127.0.0.1";
        private $username="root";
        private $password="";
        private $database="quizzeo";
        private $intitule;
        private $difficulte;
        private $date;

        public function __construct(){
            $this->host=$host;
            $this->username=$username;
            $this->password=$pwd;
            $this->database=$bdd;
            $this->intitule=$int;
            $this->diffficulte=$diff;
            $this->date=$date;
// Connexion des questions à la BDD
            {
                $this->conn = msqli_connect($this->host,$this->username,$this->password,$this->database);
                if($this->conn->connect_error){
                    echo "Echec de la connexion à la base de données:".$this->conn->connect_error;
                }
            }
        }
        public function set_question(){
            
        }
    }
?>
