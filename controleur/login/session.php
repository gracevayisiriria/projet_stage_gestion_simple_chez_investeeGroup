<?php
session_start();
if(!isset($_SESSION["nomUtilisateur"]))
{
    header("Location:../../index.php");
}

function infoUser()
{
     if(isset($_SESSION["nomUtilisateur"]))
        {
            $info =   $_SESSION["role"] ." <br>" . $_SESSION["nomUtilisateur"]; 
        }
        echo $info;
}
?>