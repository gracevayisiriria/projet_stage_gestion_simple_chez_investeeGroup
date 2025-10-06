<?php
$con = connectBDD();

function ToutTransanction()
{
    global $con;
    $reqAll = $con->prepare("SELECT transaction.idTransaction AS id,client.nom AS nomClient,produit.nomproduit AS nomProduit,transaction.quantite AS quantite,transaction.prixachat AS prixAchat,transaction.prixvente AS prixVente,transaction.total AS total,transaction.dateOperation AS dateOperation, transaction.typeTransaction AS typeTransaction FROM transaction JOIN produit ON produit.idproduit = transaction.idproduit JOIN client ON client.idClient  = transaction.idClient");
    $reqAll->execute(array());
    return $reqAll;
}

function NombreTransactionSelonId($id)
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT COUNT(*) AS Nbre FROM transaction WHERE 	idTransaction = ?");
   $ReqCompter->execute(array($id));
   $afficher = $ReqCompter->fetch();
   return $afficher["Nbre"];
}

function TypeQuantiteSelonId($id)
{
    global $con;
    $reqType = $con->prepare("SELECT typeTransaction,quantite,idproduit FROM transaction WHERE idTransaction = ? ");
    $reqType->execute(array($id));
    $result = $reqType->fetch();
    return $result;

}

// function ProduitSelonId($id)
// {
//     global $con;
//     $reqType = $con->prepare("SELECT idproduit FROM transaction WHERE idTransaction = ? ");
//     $reqType->execute(array());
//     $result = $reqType->fetch();
//     return $result;

// }

function ModifierQuantiteTotalDepot($quantite,$id)
{
    global $con;
    $reqModifier = $con->prepare("UPDATE produit SET  quantite = quantite - $quantite WHERE idproduit = ? ");
    $reqModifier->execute(array($quantite,$id));
}

function ModifierQuantiteTotalVente($quantite,$id)
{
    global $con;
    $reqModifier = $con->prepare("UPDATE produit SET  quantite = quantite + $quantite WHERE idproduit = ? ");
    $reqModifier->execute(array($quantite,$id));
}