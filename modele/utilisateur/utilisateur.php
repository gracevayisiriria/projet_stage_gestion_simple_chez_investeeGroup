<?php
$con = connectBDD();

function AllUtilisateur()
{
    global $con;
    $ReqUsers = $con->prepare("SELECT * FROM utilisateurs ");
    $ReqUsers->execute(array());
    return $ReqUsers;
}

function SupprimerUser($id)
{  
    global $con;
    $reqSupprimer = $con->prepare("DELETE FROM utilisateurs WHERE id = ? ");
    $reqSupprimer->execute(array($id));
}

function NombreUsersSelonId($id)
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT COUNT(*) AS Nbre FROM utilisateurs WHERE id = ?");
   $ReqCompter->execute(array($id));
   $afficher = $ReqCompter->fetch();
   return $afficher["Nbre"];
} 

function InsertUser($nomUtilisateur,$role,$password)
{
    global $con;
    $reqInsert = $con->prepare("INSERT INTO utilisateurs(nomutilisateur,role,mdp)VALUES(?,?,?)");
    $reqInsert ->execute(array($nomUtilisateur,$role,$password));
}

function VerifInformation ($nomUtilisateur,$role)
{
    global $con;
    $reqVerif = $con->prepare("SELECT COUNT(*) AS Nbre FROM utilisateurs WHERE nomutilisateur = ? AND role=? ");
    $reqVerif->execute(array($nomUtilisateur,$role));
    $show = $reqVerif->fetch();
    return $show["Nbre"];
}

function NombreUsersSelonNom($nomUtilisateur)
{   
    global $con;
   $ReqCompter = $con->prepare("SELECT COUNT(*) AS Nbre FROM utilisateurs WHERE nomutilisateur = ?");
   $ReqCompter->execute(array($nomUtilisateur));
   $afficher = $ReqCompter->fetch();
   return $afficher["Nbre"];
}

function PasswordSelonNom($nomUtilisateur)
{
    global $con;
    $ReqUsers = $con->prepare("SELECT mdp FROM utilisateurs WHERE nomutilisateur = ? ");
    $ReqUsers->execute(array($nomUtilisateur));
    return $ReqUsers;
}
function AllSelonNom($nomUtilisateur)
{
    global $con;
    $ReqUsers = $con->prepare("SELECT * FROM utilisateurs WHERE nomutilisateur = ? ");
    $ReqUsers->execute(array($nomUtilisateur));
    return $ReqUsers;
}

function AllUtilisateurSelonID($id)
{
    global $con;
    $ReqUsers = $con->prepare("SELECT * FROM utilisateurs WHERE id=? ");
    $ReqUsers->execute(array($id));
    return $ReqUsers;
}


?>