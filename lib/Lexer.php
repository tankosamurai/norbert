<?php

namespace Norbert;

class Lexer {

  function __construct($source){
    $this->source = $source;
    $this->p      = 0;
  }

  function hasNext($byte){
    return $this->p + $byte < strlen($this->source);
  }

  function substr($byte){
    return substr($this->source, $this->p, $byte);
  }

  function read($byte){
    if($this->hasNext($byte)){
      $tmp = $this->substr($byte);
      $this->p += $byte;
      return $tmp;
    }
  }

  function peek($byte){
    if($this->hasNext($byte)){
      return $this->substr($byte);
    }
  }

}

?>
