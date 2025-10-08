<?php
require_once("../../modele/utilisateur/utilisateur.php");

if(isset($_POST["valider"]))
{
    $nomUtilisateur = htmlspecialchars($_POST["nomUtilisateur"]);
    $role = htmlspecialchars($_POST["role"]);
    $password = htmlspecialchars($_POST["password"]);
    $confirmPassword = htmlspecialchars($_POST["confirmPasword"]);

    if(!empty($nomUtilisateur) && !empty($role) && !empty($password) && !empty($confirmPassword))
    {
        if($password == $confirmPassword)
        {
                $resultat = VerifInformation($nomUtilisateur,$role) ;
                if($resultat == 0) 
                {
                    $passwordHash = password_hash($password,PASSWORD_DEFAULT);
                    if($passwordHash)
                    {
                        InsertUser($nomUtilisateur,$role,$passwordHash);
                    }

                }
                else
                {
                    $errrorMessage = "L' utilisateuur existe déjà ";
                }
        }
        else
        {
            $errrorMessage ="Vous avez saisi deux mot de passe différents ! ";
        }
        
    }
    else
    {
        $errrorMessage = "Veuillez remplir tout les champs !";
    }

    if(isset($errrorMessage))
    {
        echo $errrorMessage;
    }
}
?>