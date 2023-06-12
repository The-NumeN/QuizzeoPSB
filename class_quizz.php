<?php
class Quizz{
    protected $nbquestion;

    public function __construct($nbq){
        $this->nbquestion=$nbq;
    }
    public function getnbq(){
        return $this->nbquestion;
    }
}

class Films extends Quizz{
   private $theme;
   public function __construct($theme,$nbq){
    $this->theme=$th;
   }
    public function getth(){
        return $this->theme;
    }
}

class Musique extends Quizz{
    private $theme;
    public function __construct($theme,$nbq){
     $this->theme=$th;
    }
     public function getth(){
         return $this->theme;
     }
 }

class Foot extends Quizz{
    private $theme;
    public function __construct($theme,$nbq){
     $this->theme=$th;
    }
     public function getth(){
         return $this->theme;
     }
 }
?>