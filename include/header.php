<!-- Database Connectivity -->
<?php

$servername="localhost";
$username="root";
$password="";
$database="dbmsproj";
$conn= mysqli_connect($servername,$username,$password,$database);


?>


<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   

    <title><?php echo $title ?></title>
</head>
<?php
if($title=="Index")
{

   echo' <body  style="background-image: url(images/background.jpg);
    background-size: 100% ,100%">';
}
else
{
    echo' <body  style="background-image: url(images/backgroundu.jpg);
    background-size: 100% ,100%">';
}
?>