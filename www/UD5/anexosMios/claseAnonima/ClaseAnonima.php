
<?php

$anonima= new class(10,5){
    public $base;
    public $altura;
   
    public function __construct($base,$altura){
        $this->base=$base;
        $this->altura=$altura;


    }

    public function area(){
        return ($this->base *$this->altura)/2;
    }


};


echo " resultado ". $anonima->area();

?>