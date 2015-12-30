<?php

namespace Norbert;

use SinglePack;

class NamedBinaryTag extends Compound {

    public $name;

    function pack(){
        $tmp  = $this->packedID();
        $tmp .= SinglePack\pack("n", strlen($this->name));
        $tmp .= $this->name;
        $tmp .= $this->packedBody();
        $tmp .= SinglePack\pack("C", 0);

        return $tmp;
    }

}

?>
