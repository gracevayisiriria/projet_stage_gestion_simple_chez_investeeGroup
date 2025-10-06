<?php

// creation de la fonction de la connexuion à la base de données
function connectBDD()
{
    $con = new PDO('mysql:host=localhost;dbname=gestionsimple', 'root',"");
    return $con;
}
?>

