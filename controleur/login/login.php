<?php
session_start();
if(isset($_POST["valider"]))
{
    $nomUtilisateur = htmlspecialchars($_POST["nomUtilisateur"]);
    $password = htmlspecialchars($_POST["password"]);
    if(!empty($nomUtilisateur) && !empty($password))
    {
       $nbreUsers = NombreUsersSelonNom($nomUtilisateur);
       if($nbreUsers == 0)
       {
        $errorMessage = "Ce compte n'existe pas !";
       }
       else
       {
        $VerifPassword = PasswordSelonNom($nomUtilisateur);
        $ShowResultVerifPassWord =  $VerifPassword ->fetch();
        if($ShowResultVerifPassWord && password_verify($password,$ShowResultVerifPassWord["mdp"]))
        {
             $informationUser = AllSelonNom($nomUtilisateur);
            $showResultInformationUser = $informationUser->fetch();
            if($showResultInformationUser)
            {
                $_SESSION["nomUtilisateur"] = $showResultInformationUser["nomutilisateur"];
                $_SESSION["role"] = $showResultInformationUser["role"];
                header("Location:vue/dashboard/dashboard.php");
            }
        }
        else
        {
           $errorMessage = "Le mot de passe est incorrect ! ";
        }
       }
    }
    else
    {
        $errorMessage = "Veuillez remplir tout les champs !";
    }
}
if(isset($errorMessage))
{
    echo $errorMessage;
}

?>