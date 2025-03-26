<?php




interface EnciclopediaInterface{

    public function buscarCriatura($nombre);

    public function listaCriaturas();

    public function borraCriatura(int $id);

    public function nuevaCriatura(Criatura $criatura);
}