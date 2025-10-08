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

function TypeQuantiteIdProduitSelonId($id)
{
    global $con;
    $reqType = $con->prepare("SELECT typeTransaction,quantite,idproduit FROM transaction WHERE idTransaction = ? ");
    $reqType->execute(array($id));
    $result = $reqType->fetch();
    return $result;

}

function ModifierQuantiteTotalDepot($quantite,$idProduit)
{
    global $con;
    $reqModifier = $con->prepare("UPDATE produit SET  quantite = quantite - $quantite WHERE idproduit = ? ");
    $reqModifier->execute(array($idProduit));
    return $reqModifier;
}

function ModifierQuantiteTotalVente($quantite,$idProduit)
{
    global $con;
    $reqModifier = $con->prepare("UPDATE produit SET  quantite = quantite + $quantite WHERE idproduit = ? ");
    $reqModifier->execute(array($idProduit));
    return $reqModifier;
}
function ModifierQuantiteTotalVente1($quantite,$prixAchat,$prixVente,$idProduit)
{
    global $con;
    $reqModifier = $con->prepare("UPDATE produit SET  quantite = quantite + $quantite,prixachat = ?,prixvente = ? WHERE idproduit = ? ");
    $reqModifier->execute(array($prixAchat,$prixVente,$idProduit));
    return $reqModifier;
}
function SupprimerTransactionSelonID($id)
{
    global $con;
    $reqSuppimer = $con->prepare("DELETE FROM transaction WHERE idTransaction = ? ");
    $reqSuppimer->execute(array($id));
    return $reqSuppimer;
}

function InsertTransaction($idClient,$idProduit,$type,$quantite,$prixAchat,$prixVente)
{
    global $con;
    $reqInsert = $con->prepare("INSERT INTO transaction(idClient,idproduit,typeTransaction,quantite,prixachat,prixVente,dateOperation)VALUES(?,?,?,?,?,?,NOW())");
    $reqInsert ->execute(array($idClient,$idProduit,$type,$quantite,$prixAchat,$prixVente));
    return $reqInsert;
}

function AllProduit()
{
    global $con;
    $reqAll = $con->prepare("SELECT * FROM produit");
    $reqAll->execute(array());
    return $reqAll;
}

function ToutClient()
{
    global $con;
    $reqAll = $con->prepare("SELECT * FROM client");
    $reqAll->execute(array());
    return $reqAll;
}
function QuantiteExistantProduit($idProduit)
{
   global $con;
    $reqQuantite = $con->prepare("SELECT quantite FROM produit WHERE idproduit = ?");
    $reqQuantite->execute(array($idProduit));
    $result =  $reqQuantite->fetch();
    return $result["quantite"];
} 
