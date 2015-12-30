<?php

namespace Norbert;

use SinglePack;

abstract class Base implements Packable {

    static $id;

    static $format;

    public $value;

    function __construct($value){
        $this->value = $value;
    }

    function packedID(){
        return SinglePack\pack("C", static::$id);
    }

    function pack(){
        return SinglePack\pack(static::$format, $this->value);
    }

}

?>
