<?php
include_once("../fonctions/AJAX.php");

session_start();


if (!isset($_POST["action"]))
{
    ajaxError("Action non définie");
}

$action = $_POST["action"];

switch ($action)
{
	case "mail_contact" :
		if ((!isset($_POST["from_email"])) || (!isset($_POST["from_name"])) || (!isset($_POST["subject"])) || (!isset($_POST["html"])))
		{
			ajaxError("Des informations sont manquantes");
		}
		else{
			mail("andoslash@hotmail.fr", $_POST["subject"], $_POST["html"]);
			alert("Merci" + $_POST["from_name"] + "votre mail a bien été envoyé.");
		}
		
		break;
		
	default:
		ajaxError("Action inconnue");
}

?>