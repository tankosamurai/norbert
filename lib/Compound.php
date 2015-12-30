<?php

namespace Norbert;

use SinglePack;

class Compound implements Packable {

    static $id = 0x0a;

    private $data = [];

    function get($key){
        return $this->data[$key];
    }

    function setByte($key, $value){
        return $this->data[$key] = new Byte($value);
    }

    function setShort($key, $value){
        return $this->data[$key] = new Short($value);
    }

    function setInt($key, $value){
        return $this->data[$key] = new Int($value);
    }

    function setLong($key, $value){
        return $this->data[$key] = new Long($value);
    }

    function setFloat($key, $value){
        return $this->data[$key] = new Float($value);
    }

    function setDouble($key, $value){
        return $this->data[$key] = new Double($value);
    }

    function setString($key, $value){
        return $this->data[$key] = new String($value);
    }

    function setCompound($key){
        return $this->data[$key] = new Compound();
    }

    function packedID(){
        return SinglePack\pack("C", 0x0a);
    }

    function packedBody(){
        $tmp = "";

        foreach($this->data as $key => $value){
            $name = strval($key);

            $tmp .= $value->packedID();
            $tmp .= SinglePack\pack("n", strlen($name));
            $tmp .= $name;
            $tmp .= $value->pack();
        }

        return $tmp;
    }

    function pack(){
        $tmp = "";
        // $tmp  = $this->packedID();
        $tmp .= $this->packedBody();
        $tmp .= SinglePack\pack("C", 0);

        return $tmp;
    }

}

?>
