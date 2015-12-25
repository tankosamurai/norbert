<?php

namespace Norbert;

use SinglePack;

class NameTag {

    public $name;

    public $value;

    function pack(){
        $tmp  = "";
        $tmp .= $this->value->packedID();
        $tmp .= SinglePack\pack("n", strlen($this->name));
        $tmp .= $this->name;
        $tmp .= $this->value->pack();
        return $tmp;
    }

}

?>
