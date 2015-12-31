# Norbert

Named Binary Tag (NBT) parser.

by @tankosamurai

# Example

Opening a file.

```
<?php

$level = Norbert\NamedBinaryTag::open("./level.dat");
$level->get("Data")->get("version"); #=> 19132

?>
```

Writing a file.

```
<?php

$level = Norbert\NamedBinaryTag::open("./level.dat");
$level->get("Data")->setInt("version", 19134);
$level->save("./level.dat");

?>
```
