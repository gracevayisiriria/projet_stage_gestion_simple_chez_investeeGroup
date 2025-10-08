<?php
require_once("../../modele/transaction/transaction.php");

if(isset($_POST["valider"]))
{
    $idClient = htmlspecialchars($_POST["client"]);
    $idProduit = htmlspecialchars($_POST["produit"]);
    $typetransaction = htmlspecialchars($_POST["type"]);
    $quantite = htmlspecialchars($_POST["quantite"]);
    $prixAchat = htmlspecialchars($_POST["prixAchat"]);
    $prixVente = htmlspecialchars($_POST["prixVente"]);

    if(!empty($idClient) && !empty($idProduit) && !empty($typetransaction) && !empty( $quantite) && !empty($prixVente))
    {
                    $insersion = InsertTransaction($idClient,$idProduit,$typetransaction,$quantite,$prixAchat,$prixVente);
                    if($insersion)
                    {
                        if($typetransaction == "vente")
                        { 
                            $quantiteProduit =  QuantiteExistantProduit($idProduit);
                            if($quantite > $quantiteProduit)
                            {
                                $errrorMessage = "Le stock est insuffisant";
                            }
                            else
                            {
                                ModifierQuantiteTotalDepot($quantite,$idProduit);
                            }
                        }
                        elseif($typetransaction == "depot")
                        {
                            ModifierQuantiteTotalVente1($quantite,$prixAchat,$prixVente,$idProduit);
                        }

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