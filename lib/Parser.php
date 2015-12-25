<?php

namespace Norbert;

use SinglePack;
use Norbert\Nametag;
use Norbert\Byte;
use Norbert\Short;
use Norbert\Int;
use Norbert\Long;
use Norbert\Float;
use Norbert\Double;

class Parser {

    function __construct($lexer){
        $this->lexer = $lexer;
    }

    function peekUnpack($format, $length){
        return SinglePack\unpack($format, $this->lexer->peek($length));
    }

    function readUnpack($format, $length){
        return SinglePack\unpack($format, $this->lexer->read($length));
    }

    function parse(){
        while($this->lexer->hasNext(1)){
            $header = $this->readUnpack("C", 1);

            switch($header){
                case 0:
                    echo "[End]" . PHP_EOL;
                    break;
                case 1:
                    $length = $this->readUnpack("n", 2);
                    $name     = $this->lexer->read($length);
                    $value    = $this->readUnpack("C", 1);

                    $nametag = new Nametag($name);
                    $nametag->value = new Byte($value);

                    break;
                case 2:
                    $length = $this->readUnpack("n", 2);
                    $name     = $this->lexer->read($length);
                    $value    = $this->readUnpack("n", 2);

                    $nametag = new Nametag($name);
                    $nametag->value = new Short($value);

                    print_r($nametag);

                    break;
                case 3:
                    $length = $this->readUnpack("n", 2);
                    $name     = $this->lexer->read($length);
                    $value    = $this->readUnpack("N", 4);

                    $nametag = new Nametag($name);
                    $nametag->value = new Int($value);

                    print_r($nametag);

                    break;
                case 4:
                    $length = $this->readUnpack("n", 2);
                    $name     = $this->lexer->read($length);
                    $value    = $this->readUnpack("J", 8);

                    $nametag = new Nametag($name);
                    $nametag->value = new Long($value);

                    print_r($nametag);

                    break;
                case 5:
                    $length = $this->readUnpack("n", 2);
                    $name     = $this->lexer->read($length);
                    $value    = $this->readUnpack("F", 4);
                    break;
                case 6:
                    echo "Double not supported yet." . PHP_EOL;
                    break;
                case 7:
                    break;
                case 8:
                    $length = $this->readUnpack("n", 2);
                    $name     = $this->lexer->read($length);
                    $valueL = $this->readUnpack("n", 2);
                    $value    = $this->lexer->read($valueL);
                    break;
                case 9:
                    break;
                case 10:
                    break;
                case 11:
                    break;
            }
        }
    }

}

?>
