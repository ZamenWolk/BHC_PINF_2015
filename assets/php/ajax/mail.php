<?php
include_once("../fonctions/AJAX.php");

session_start();


if (!isset($_POST["action"]))
{
    ajaxError("Action non définie");
}
$action = $_POST["action"];
$headers = 'From:'. $_POST["from_email"] . "\r\n" .
     'Reply-To:' . $_POST["from_email"] . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

$tab["message"]="Votre mail a bien été envoyé";
switch ($action)
{
	case "mail_contact" :
		if ((!isset($_POST["from_email"])) || (!isset($_POST["from_name"])) || (!isset($_POST["subject"])) || (!isset($_POST["html"])))
		{
			ajaxError("Des informations sont manquantes", "MISSING_ARGUMENTS");
		}
		else{
			mail("martin.canivez@gmail.com", $_POST["subject"], $_POST["html"], $headers);
			ajaxSuccess($tab);
		}
		break;
	case "newsletter" : 
		if ((!isset($_POST["objet"])) || ((!isset($_POST["texte"]))) )
			ajaxError("Des informations sont manquantes", "MISSING_ARGUMENTS")
		else {
			
		}
		break;
		
	default:
		ajaxError("Action inconnue");
}

?>