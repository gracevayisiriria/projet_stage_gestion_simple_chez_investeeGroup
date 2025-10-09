<?php
if(!isset($_GET["id"]))
{
    header("Location:../produit/produit.php");
}
else
{
    $id = htmlspecialchars($_GET["id"]);
   $nombreUtilisateur = NombreUsersSelonId($id);
   if($nombreUtilisateur == 0)
   {
      header("Location:../utilisateur/utilisateur");
   }
   else
   {
    $UtilisateurInformation = AllUtilisateurSelonID($id);
    $ShowInformation = $UtilisateurInformation->fetch();
   }
}


if(isset($_POST["valider"]))
{
    $nomProduit = htmlspecialchars($_POST["produit"]);
    $prixAchat = htmlspecialchars($_POST["prixAchat"]);
    $prixVente = htmlspecialchars($_POST["prixVente"]);
    
    if(!empty($nomProduit) || !empty($prixAchat) || !empty($prixVente))
    {
       $modifier =  ModifierProduit($nomProduit,$prixAchat,$prixVente,$id);
       if($modifier)
       {
        header("Location:../produit/produit.php");
       }
       else
       {
        $errorMessage = "La modification n'a pas abouti à la fin";
       }
    }
    else
    {
        $errorMessage = "Veuiller remplir tout les champs";
    }

}
if(isset($errorMessage))
{
    echo $errorMessage;
}
?>