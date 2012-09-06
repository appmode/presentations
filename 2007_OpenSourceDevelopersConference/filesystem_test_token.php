<?php
require ('filesystem_token.php');
require ('filesystem.php');

$FileSystem = new FileSystemTokenObject();

echo $FileSystem->home->flame->www->path('test.php');
echo "<br>";
echo $FileSystem->home->flame->www->exists('test.php');
echo "<br>";
echo $FileSystem->home->flame->www->contents('test.php');
echo "<br>";

$FileSystem = new FileSystemObject();

echo $FileSystem->home->flame->www->path('test.php');
echo "<br>";
echo $FileSystem->home->flame->www->exists('test.php');
echo "<br>";
echo $FileSystem->home->flame->www->contents('test.php');
echo "<br>";
?>
