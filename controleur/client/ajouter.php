<?php
require_once("../../modele/client/client.php");

if(isset($_POST["valider"]))
{
    $nom = htmlspecialchars($_POST["nom"]);
    $postnom = htmlspecialchars($_POST["postnom"]);
    $telephone = htmlspecialchars($_POST["telephone"]);
    $adresse = htmlspecialchars($_POST["adresse"]);

    if(!empty($nom) && !empty($postnom) && !empty($telephone) && !empty($adresse))
    {
        VerifInformation($postnom,$telephone) ;
        $resultat = VerifInformation($postnom,$telephone) ;
       if($resultat == 0) 
       {
        InsertClient($nom,$postnom,$telephone,$adresse);

       }
       else
       {
        $errrorMessage = "Le client existe";
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