<?php
require("../../modele/bdd/connectBDD.php");
require("../../modele/transaction/transaction.php");
if(isset($_GET["id"]))
{
    $id = htmlspecialchars($_GET["id"]);
    $nombre = NombreTransactionSelonId($id);
    if($nombre == 0)
    {
        echo "Vous ete perdu ! ";
    }
    else
    {
        $resultat = TypeQuantiteIdProduitSelonId($id);
        $type = $resultat["typeTransaction"];
        $quantite = $resultat["quantite"];
        $idProduit = $resultat["idproduit"];

        if($type == "depot")
        {
        $modifierProduit =  ModifierQuantiteTotalDepot($quantite,$idProduit);
        if($modifierProduit)
        {
            $suppression =  SupprimerTransactionSelonID($id);
            if($suppression)
            {
              header("location:../../vue/transaction/transaction.php");
                
            }
        }
        else
        {
            echo "Il y a une erreur !";
        }

        }
        elseif($type=="vente")
        {
            $modifierProduit = ModifierQuantiteTotalVente($quantite,$idProduit);
            if($modifierProduit)
            {
                 $suppression =  SupprimerTransactionSelonID($id);
            if($suppression)
            {
              header("location:../../vue/transaction/transaction.php");
                
            }
            }
            else
            {
                echo "Il y a une erreur !";
            }
        }
    }
    
}
?>