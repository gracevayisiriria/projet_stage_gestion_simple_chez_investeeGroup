<?php
// 

$con = connectBDD();

function NombreClientTotal()
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT COUNT(*) AS Nbre FROM client");
   $ReqCompter->execute(array());
   $afficher = $ReqCompter->fetch();
   return $afficher["Nbre"];
}

function NombreProduitTotal()
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT COUNT(*) AS Nbre FROM produit");
   $ReqCompter->execute(array());
   $afficher = $ReqCompter->fetch();
   return $afficher["Nbre"];
}

function NombreTransactionTotal()
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT COUNT(*) AS Nbre FROM transaction ");
   $ReqCompter->execute(array());
   $afficher = $ReqCompter->fetch();
   return $afficher["Nbre"];
}
function NombreTransactionJournalier()
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT COUNT(*) AS Nbre FROM transaction WHERE DAY(dateOperation) = DAY(CURDATE()) ");
   $ReqCompter->execute(array());
   $afficher = $ReqCompter->fetch();
   return $afficher["Nbre"];
}

function ChiffreAffaireJournalier($typeTransaction)
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT SUM(total) AS Somme FROM transaction WHERE typeTransaction = ? AND DAY(dateOperation) = DAY(CURDATE())");
   $ReqCompter->execute(array($typeTransaction));
   $afficher = $ReqCompter->fetch();
   return $afficher["Somme"];
}


function NombreDepotJournalier($typeTransaction)
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT COUNT(*) AS Nbre FROM transaction WHERE typeTransaction = ? AND DAY(dateOperation) = DAY(CURDATE()) ");
   $ReqCompter->execute(array($typeTransaction));
   $afficher = $ReqCompter->fetch();
   return $afficher["Nbre"];
}




?>