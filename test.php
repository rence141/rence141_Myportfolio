<?php
echo "Hello World! PHP is working!";
echo "<br>Current directory: " . getcwd();
echo "<br>Files in directory: ";
$files = scandir('.');
foreach($files as $file) {
    if($file != '.' && $file != '..') {
        echo "<br>- " . $file;
    }
}
?> 