<?php

namespace Norbert;

use SinglePack;

class NamedBinaryTag extends Compound {

    public $name;

    static function open($filename){
        $gz  = file_get_contents($filename);
        $bin = gzdecode($gz);
        $lex = new Lexer($bin);
        $par = new Parser($lex);
        $nbt = $par->parse();
        return $nbt;
    }

    function save($filename){
        $bin = $this->pack();
        $gz  = gzencode($bin);
        return file_put_contents($filename, $gz);
    }

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
