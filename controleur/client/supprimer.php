<?php
require("../../modele/bdd/connectBDD.php");
require("../../modele/client/client.php");
if(isset($_GET["id"]))
{
    $id = htmlspecialchars($_GET["id"]);
    $nombre = NombreClientSelonId($id);
    if($nombre == 0)
    {
      header("location:../../vue/client/client.php");
    }
    else
    {
        SupprimerClient($id);
         header("location:../../vue/client/client.php");
    }
}
?>