<?php
$con = connectBDD();

function NombreClientTotal()
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT COUNT(*) AS Nbre FROM client");
   $ReqCompter->execute(array());
   $afficher = $ReqCompter->fetch();
   return $afficher["Nbre"];
}

function ToutUtilisateur()
{
    global $con;
    $reqAll = $con->prepare("SELECT * FROM client");
    $reqAll->execute(array());
    return $reqAll;
}

function NombreClientSelonId($id)
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT COUNT(*) AS Nbre FROM client WHERE idclient = ?");
   $ReqCompter->execute(array($id));
   $afficher = $ReqCompter->fetch();
   return $afficher["Nbre"];
} 

// Creation de la fonction pour supprimer un client
function SupprimerClient($id)
{  
    global $con;
    $reqSupprimer = $con->prepare("DELETE FROM client WHERE idclient = ? ");
    $reqSupprimer->execute(array($id));
}

function VerifInformation ($postnom,$telephone)
{
    global $con;
    $reqVerif = $con->prepare("SELECT COUNT(*) AS Nbre FROM client WHERE postnom = ? AND numero_telephone=? ");
    $reqVerif->execute(array($postnom,$telephone));
    $show = $reqVerif->fetch();
    return $show["Nbre"];
}
function InsertClient($nom,$postnom,$telephone,$adresse)
{
    global $con;
    $reqInsert = $con->prepare("INSERT INTO client(nom,postnom,numero_telephone,adresse)VALUES(?,?,?,?)");
    $reqInsert ->execute(array($nom,$postnom,$telephone,$adresse));
}
?>