<?php

namespace Norbert;

use SinglePack;

class Compound {

    public $name;

    private $data;

    function __construct(){
        $this->name = "";
        $this->data = [];
    }

    function __get($key){
        return $this->data[$key];
    }

    function __set($key, $value){
        $this->data[$key] = $value;
    }

    function pack(){
        $tmp  = "";
        $tmp .= SinglePack\pack("C", 0x0a);
        $tmp .= SinglePack\pack("n", strlen($this->name));
        $tmp .= $this->name;

        foreach($this->data as $key => $value){
            // $length = strlen($key);
            // $tmp .= SinglePack\pack("n", $length);
            // $tmp .= $key;
            $tmp .= $value->pack();
        }

        $tmp .= SinglePack\pack("C", 0);

        return $tmp;
    }

}

?>
