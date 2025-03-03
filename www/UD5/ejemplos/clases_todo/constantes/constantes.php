<?php 


class Goodbye {
    const LEAVING_MESSAGE = "Adiós, nos vemos pronto!";
  public function byebye() {
    echo self::LEAVING_MESSAGE;
  }
  }
  
  echo Goodbye::LEAVING_MESSAGE;



  $goodbye = new Goodbye();
$goodbye->byebye();