<?php

namespace Norbert;

use ArrayAccess;
use IteratorAggregate;
use ArrayIterator;
use SinglePack;

class Compound implements ArrayAccess, IteratorAggregate {

    public $name;

    private $data;

    function __construct($name = ""){
        $this->name = $name;
        $this->data = [];
    }

    function offsetExists($offset){
        return isset($this->data[$offset]);
    }

    function offsetGet($offset){
        return $this->data[$offset];
    }

    function offsetSet($offset, $value){
        return $this->data[$offset] = $value;
    }

    function offsetUnset($offset){
        unset($this->data[$offset]);
    }

    function getIterator(){
        return new ArrayIterator($this->data);
    }

    function packedID(){
        return SinglePack\pack("C", 0x0a);
    }

    function pack(){
        $tmp  = "";

        foreach($this as $offset => $value){
            $name = strval($offset);

            $tmp .= $value->packedID();
            $tmp .= SinglePack\pack("n", strlen($name));
            $tmp .= $name;
            $tmp .= $value->pack();
        }

        $tmp .= SinglePack\pack("C", 0);

        return $tmp;
    }

}

?>
