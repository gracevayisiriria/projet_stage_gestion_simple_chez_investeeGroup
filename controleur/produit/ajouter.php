<?php
require_once("../../modele/produit/produit.php");

if(isset($_POST["valider"]))
{
    $nomProduit = htmlspecialchars($_POST["nomProduit"]);

    if(!empty($nomProduit))
    {
       VerifInformation ($nomProduit) ;
        $resultat = VerifInformation ($nomProduit) ;
       if($resultat == 0) 
       {
         InsertProduit($nomProduit);

       }
       else
       {
        $errrorMessage = "Le produit existe déjà !";
       }
        
    }
    else
    {
        $errrorMessage = "Veuillez remplir tout les champs !";
    }

    if(isset($errrorMessage))
    {
        echo $errrorMessage;
    }
}
?>