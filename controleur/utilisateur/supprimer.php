<?php
require("../../modele/bdd/connectBDD.php");
require("../../modele/utilisateur/utilisateur.php");
if(isset($_GET["id"]))
{
    $id = htmlspecialchars($_GET["id"]);
    $nombre = NombreUsersSelonId($id);
    if($nombre == 0)
    {
      header("location:../../vue/utilisateur/utilisateur.php");
    }
    else
    {
        SupprimerUser($id);
        header("location:../../vue/utilisateur/utilisateur.php");
    }
}
?>