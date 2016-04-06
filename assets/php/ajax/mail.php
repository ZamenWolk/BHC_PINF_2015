<?php

include_once "../../../secret/credentials.php";
include_once("../fonctions/AJAX.php");

session_start();


if (!isset($_POST["action"]))
{
    ajaxError("Action non définie");
}
$action = $_POST["action"];

if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}



$tab["message"]="Votre mail a bien été envoyé";
switch ($action)
{
	case "mail_contact" :
		
		if ((!isset($_POST["from_email"])) || (!isset($_POST["from_name"])) || (!isset($_POST["subject"])) || (!isset($_POST["html"])))
		{
			ajaxError("Des informations sont manquantes", "MISSING_ARGUMENTS");
		}
		else{
		$header = "From: ". $_POST["from_name"] . $_POST["from_email"].$passage_ligne;
		$header .= "Reply-to:". $_POST["from_name"] . $_POST["from_email"].$passage_ligne;
		$header .= "MIME-Version: 1.0".$passage_ligne;
		$header .= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
			mail("bonpneus@hotmail.fr", $_POST["subject"], $_POST["html"], $headers);
			ajaxSuccess($tab);
		}
		break;
		
	case "newsletter" : 
		if ((!isset($_POST["objet"])) || ((!isset($_POST["texte"]))) ){
			
			ajaxError("Des informations sont manquantes", "MISSING_ARGUMENTS");
			
		}
		else {
			ajaxSuccess($tab);
		}
		break;
		
	default:
		ajaxError("Action inconnue");
		break;
}

?>