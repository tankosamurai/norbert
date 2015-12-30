<?php

require "./vendor/autoload.php";

// $p = new Norbert\Parser();
// $p->parse();

$gzsrc  = file_get_contents("./level.dat");
$source = gzdecode($gzsrc);
$lexer  = new Norbert\Lexer($source);
$parser = new Norbert\Parser($lexer);
$nbt    = $parser->parse();
// print_r($nbt);

// $nbt  = new Norbert\NamedBinaryTag();
// $nbt->setShort("Air", 300);
// $nbt->setCompound("Achievements");
// $nbt->get("Achievements")->setByte("mineWood", 1);
// $nbt->setString("hogeString", "hogehoge");

// print_r(unpack("C*", $com->pack()));

// print_r($com);

file_put_contents("./test", $nbt->pack());

?>
