<?php


interface CalculosCentroEstudioss{


    public function numeroDeAprobadoss();

    

    public function numeroDeSuspensoss();



    public function notaMediass();

    
}


abstract class Notass
 {
    protected $notass;

    public function __construct($notas)
{
    $this->notass=$notas;
}

    public function getnotass(){
        return $this->notass;
    }



    public function toStrings()
    {
        $listaDeNotas = "";
        foreach ($this->getnotass() as $nota) {
            $listaDeNotas .= "[$nota]";
        }
        return $listaDeNotas;
    }


   
   

}

class NotasDaww  extends Notass implements CalculosCentroEstudioss{

    public function numeroDeAprobadoss()
    {
        $aprobados=0;
        foreach($this->notass as $nota)
        {
            if($nota>=5)
            {
                $aprobados++;
            }

        }
        return $aprobados;
    }

    public function numeroDeSuspensoss(){

        $suspensos=0;
        foreach($this->notass as $nota)
        {
            if($nota<5){
                $suspensos++;
            }

        }
        return $suspensos;
    }


    public function notaMediass(){
      
        $total=array_sum($this->notass);
        //3 numero de decimas
        return round($total /count ($this->notass), 3);

    }

    public function toStrings(){
        return parent::toStrings();
    }

}



$notasArrayy=[4,5,7,1,8,9];
$notasDaww=new NotasDaww($notasArrayy);

echo "Notas: ".$notasDaww->toStrings()."<br>";
echo "Numero de aprobados: ".$notasDaww->numeroDeAprobadoss()."<br>";
echo "Numero de suspensos: ".$notasDaww->numeroDeSuspensoss()."<br>";
echo "Nota media: ".$notasDaww->notaMediass()."<br>";



?>