<?php

trait CalculosCentroEstudos{
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
}

trait MostrarCalculos
{
    function saludo(){
        return "Bienvenido al centro de cálculo";
    }

    function showCalculusStudyCenter($numberoaprobados,$numerosuspensos,$media)
    {
        
    }

}



class NotasTraitt
{

}

?>