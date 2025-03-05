<?php

class DatabaseException extends Exception
{
    public $method;
    public $sql;
    public function __construct($message, $method, $sql, $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->method = $method;
        $this->sql = $sql;

       
       
    }


    public function getMethod()
    {
        return $this->method;
    }

    public function getSql()
    {
        return $this->sql;
    }
}




?>