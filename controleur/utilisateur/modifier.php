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
    $nomUtilisateur = htmlspecialchars($_POST["nom"]);
    $role = htmlspecialchars($_POST["role"]);
    $password = htmlspecialchars($_POST["password"]);
    $passwordHash = password_hash($password,PASSWORD_DEFAULT);
    
    if(!empty($nomUtilisateur) || !empty($role) || !empty($password))
    {
       $modifier =  ModifierUtilisateur($nomUtilisateur,$role,$passwordHash,$id);
       if($modifier)
       {
        header("Location:../utilisateur/utilisateur");
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