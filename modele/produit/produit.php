<?php
$con = connectBDD();

function NombreProduitTotal()
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT COUNT(*) AS Nbre FROM produit");
   $ReqCompter->execute(array());
   $afficher = $ReqCompter->fetch();
   return $afficher["Nbre"];
}

function ToutProduit()
{
    global $con;
    $reqAll = $con->prepare("SELECT * FROM produit");
    $reqAll->execute(array());
    return $reqAll;
}
function NombreProduitSelonId($id)
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT COUNT(*) AS Nbre FROM produit WHERE 	idproduit = ?");
   $ReqCompter->execute(array($id));
   $afficher = $ReqCompter->fetch();
   return $afficher["Nbre"];
} 

function SupprimerProduit($id)
{  
    global $con;
    $reqSupprimer = $con->prepare("DELETE FROM produit WHERE idproduit = ? ");
    $reqSupprimer->execute(array($id));
}

function VerifInformation ($nomProduit)
{
    global $con;
    $reqVerif = $con->prepare("SELECT COUNT(*) AS Nbre FROM produit WHERE nomproduit = ? ");
    $reqVerif->execute(array($nomProduit));
    $show = $reqVerif->fetch();
    return $show["Nbre"];
}
function InsertProduit($nomProduit)
{
    global $con;
    $reqInsert = $con->prepare("INSERT INTO produit(nomproduit,quantite,prixachat,prixvente)VALUES(?,0,0,0)");
    $reqInsert ->execute(array($nomProduit));
    return $reqInsert;
}
?>