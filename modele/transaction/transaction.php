<?php
$con = connectBDD();

function ToutTransanction()
{
    global $con;
    $reqAll = $con->prepare("SELECT transaction.idTransaction AS id,client.nom AS nomClient,produit.nomproduit AS nomProduit,transaction.quantite AS quantite,transaction.prixachat AS prixAchat,transaction.prixvente AS prixVente,transaction.total AS total,transaction.dateOperation AS dateOperation, transaction.typeTransaction AS typeTransaction FROM transaction JOIN produit ON produit.idproduit = transaction.idproduit JOIN client ON client.idClient  = transaction.idClient");
    $reqAll->execute(array());
    return $reqAll;
}