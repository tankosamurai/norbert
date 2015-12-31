<?php

namespace Norbert;

use SinglePack;

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

    function parseCompound($com){
        while($this->lexer->hasNext(1)){
            $header = $this->readUnpack("C", 1);

            switch($header){
                case 0:
                    return $com;
                    break;
                case 1:
                    $length = $this->readUnpack("n", 2);
                    $name   = $this->lexer->read($length);
                    $value  = $this->readUnpack("C", 1);
                    $com->setByte($name, $value);
                    break;
                case 2:
                    $length = $this->readUnpack("n", 2);
                    $name   = $this->lexer->read($length);
                    $value  = $this->readUnpack("n", 2);
                    $com->setShort($name, $value);
                    break;
                case 3:
                    $length = $this->readUnpack("n", 2);
                    $name   = $this->lexer->read($length);
                    $value  = $this->readUnpack("N", 4);
                    $com->setInt($name, $value);
                    break;
                case 4:
                    $length = $this->readUnpack("n", 2);
                    $name   = $this->lexer->read($length);
                    $value  = $this->readUnpack("J", 8);
                    $com->setLong($name, $value);
                    break;
                case 5:
                    $length = $this->readUnpack("n", 2);
                    $name   = $this->lexer->read($length);
                    $value  = $this->readUnpack("F", 4);
                    $com->setFloat($name, $value);
                    break;
                case 6:
                    $length = $this->readUnpack("n", 2);
                    $name   = $this->lexer->read($length);
                    $value  = $this->readUnpack("F", 4);
                    $com->setDouble($name, $value);
                    break;
                case 7:
                    break;
                case 8:
                    $length = $this->readUnpack("n", 2);
                    $name   = $this->lexer->read($length);
                    $valueL = $this->readUnpack("n", 2);
                    $value  = $this->lexer->read($valueL);
                    $com->setString($name, $value);
                    break;
                case 9:
                    $length = $this->readUnpack("n", 2);
                    $name   = $this->lexer->read($length);
                    $id     = $this->readUnpack("C", 1);
                    $valueL = $this->readUnpack("N", 4);
                    break;
                case 10:
                    $length = $this->readUnpack("n", 2);
                    $name   = $this->lexer->read($length);
                    $sub    = $com->setCompound($name);
                    $this->parseCompound($sub);
                    return $com;
                    break;
                case 11:
                    break;
            }
        }

    }

    function parse(){
        $nbt = new NamedBinaryTag();

        while($this->lexer->hasNext(1)){
            $header = $this->readUnpack("C", 1);

            if($header === 10){
                $length = $this->readUnpack("n", 2);
                $name   = $this->lexer->read($length);
                return $this->parseCompound($nbt);
            }
        }
    }

}

?>
