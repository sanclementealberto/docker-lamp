<?php

trait CalculosCentroEstudos{
    public function numeroDeAprobadoss($notas)
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

    
    public function numeroDeSuspensoss($notas){

        $suspensos=0;
        foreach($this->notass as $nota)
        {
            if($nota<5){
                $suspensos++;
            }

        }
        return $suspensos;
    }



    public function notaMediass($notas){
      
        $total=array_sum($this->notass);
        //3 numero de decimas
        return round($total /count ($this->notass), 3);

    
    
    
    }
}

trait MostrarCalculos
{
    function saludo(){
        return "Bienvenido al centro de cálculo";
    }

    function showCalculusStudyCenter($numberoaprobados,$numerosuspensos,$media)
    {
        echo "Número de aprobados: $numberoaprobados<br>";
        echo "Número de suspensos: $numerosuspensos<br>";
        echo "Nota media: $media<br>";

    }

}



class NotasTraitt
{
    use CalculosCentroEstudos;
    use MostrarCalculos;

    private $notas;

    public function __construct($notas)
    {
        $this->notas=$notas;
    }

    public function calcularYMostrar()
    {
        $aprobados=$this->numeroDeAprobadoss($this->notas);
        $suspendidos=$this->numeroDeSuspensoss($this->notas);
        $notaMedia=$this->notaMediass($this->notas);

        $this->saludo();
        $this->showCalculusStudyCenter($aprobados,$suspendidos,$notaMedia);
    }
}


$notas_trait= new NotasTraitt([4,5,7,1,9]);

$notas_trait->calcularYMostrar();

?>