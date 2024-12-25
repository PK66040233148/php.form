<?php
$myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
$txt = "Jack Sparrow\n";
fwrite($myfile, $txt);
$txt = "Jack Sparrow\n";
fwrite($myfile, $txt);
fclose($myfile);
?>

