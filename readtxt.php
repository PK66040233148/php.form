<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Textfile</title>
</head>
<body>
<?php
    echo "<h1>การใช้ fread</h1>";
    $myfile = fopen("myname.txt", "r") or die("Unable to open file!");
    echo fread($myfile,filesize("myname.txt"));
    fclose($myfile);

    echo "<h1>การใช้ fgets</h1>";
    $myfile = fopen("myname.txt", "r") or die("Unable to open file!");
    echo fgets($myfile);
    fclose($myfile);

    echo "<h1>การใช้ feof</h1>";
        $myfile = fopen("myname.txt", "r") or die("Unable to open file!");
    // Output one line until end-of-file
    while(!feof($myfile)) {
    echo fgets($myfile) . "<br>";
    }
    fclose($myfile);

?>

</body>
</html>