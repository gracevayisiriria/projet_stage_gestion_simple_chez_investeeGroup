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

        if()
    }
    
}
?>