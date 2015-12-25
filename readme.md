# Norbert

Named Binary Tag (NBT) parser.

by @tankosamurai

# Example

Opening a file.

```
<?php

$gzsrc  = file_get_contents("./a_file.dat");
$source = gzdecode($gzsrc);
$lexer  = new Norbert\Lexer($source);
$parser = new Norbert\Parser($lexer);
$tree   = $parser->parse();

?>
```

Writing a file.

```
<?php

$com  = new Norbert\Compound();
$com->name = "Data";

$tag  = new Norbert\NameTag();
$tag->name = "boom";
$tag->value = new Norbert\Byte(1);

$com->hoge = $tag;
file_put_contents("./test", $com->pack());
?>
```
