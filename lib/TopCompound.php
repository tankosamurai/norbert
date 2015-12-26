<?php

namespace Norbert;

use SinglePack;

class TopCompound extends Compound {

    function pack(){
        $tmp  = SinglePack\pack("C", 0x0a);
        $tmp .= SinglePack\pack("n", strlen($this->name));
        $tmp .= $this->name;

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
