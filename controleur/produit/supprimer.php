<?php
require("../../modele/bdd/connectBDD.php");
require("../../modele/produit/produit.php");
if(isset($_GET["id"]))
{
    $id = htmlspecialchars($_GET["id"]);
    $nombre = NombreProduitSelonId($id);
    if($nombre == 0)
    {
      header("location:../../vue/produit/produit.php");
    }
    else
    {
        SupprimerProduit($id);
         header("location:../../vue/produit/produit.php");

    }
}
?>