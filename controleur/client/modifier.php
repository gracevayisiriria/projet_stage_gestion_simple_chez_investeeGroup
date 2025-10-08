<?php
if(!isset($_GET["id"]))
{
    header("Location:../client/client.php");
}
else
{
    $id = htmlspecialchars($_GET["id"]);
   $nombreClient =  NombreClientSelonId($id);
   if($nombreClient == 0)
   {
    header("Location:../client/client.php");
   }
   else
   {
    $ClientInformation = ToutClientSelonId($id);
   }
}


if(isset($_POST["valider"]))
{
    $nom = htmlspecialchars($_POST["nom"]);
    $postnom = htmlspecialchars($_POST["postnom"]);
    $telephone = htmlspecialchars($_POST["telephone"]);
    $adresse = htmlspecialchars($_POST["adresse"]);

    if(!empty($nom) && !empty($postnom) && !empty($telephone) && !empty($adresse))
    {
       $modifier =  ModifierClient($nom,$postnom,$telephone,$adresse,$id);
       if($modifier)
       {
        header("Location:../client/client.php");
       }
    }

}

?>