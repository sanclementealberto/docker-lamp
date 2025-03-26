<?php


enum Tipo:string{
    case FUEGO="fuego";

    case AGUA="agua";

    case TIERRA="tierra";

    public function tipo()
    {
        return match($this)
        {
            Tipo::FUEGO=>"fuego",
            Tipo::AGUA=>"agua",
            Tipo::TIERRA=>"tierra",
        };
    }
}











?>