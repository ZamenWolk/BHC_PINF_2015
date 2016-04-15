<?php

include_once "../../../secret/credentials.php";
include_once("../fonctions/AJAX.php");

session_start();


if (!isset($_POST["action"]))
{
    ajaxError("Action non définie");
}
$action = $_POST["action"];
if(isset($_POST["to_email"]))
    $mail_contact = $_POST["to_email"];
else
    $mail_contact = "contact@js-pneus.fr";


$tab["message"]="Votre mail a bien été envoyé";
switch ($action)
{
	case "mail_contact" :
        //fonctionnel
        if(isset($_POST["from_email"]) && isset($_POST["from_name"]) && isset($_POST["subject"]) && isset($_POST["html"])) {


            if($_POST["from_email"] == "" || !strstr($_POST["from_email"], "@"))

                ajaxError("mauvaise email", "WRONG_EMAIL");


            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail_contact)) // On filtre les serveurs qui rencontrent des bogues.

            {

                $passage_ligne = "\r\n";

            } else {

                $passage_ligne = "\n";

            }

//=====Déclaration des messages au format texte et au format HTML.

            $message_txt = $_POST["html"];

            $message_html = "<html><head></head><body>" . $_POST["html"] . "</body></html>";

//==========


//=====Création de la boundary

            $boundary = "-----=" . md5(rand());

//==========


//=====Définition du sujet.

            $sujet = $_POST["subject"];

//=========


//=====Création du header de l'e-mail.

            $header = "From: \"" . $_POST["from_name"] . "\"<" . $_POST["from_email"] . ">" . $passage_ligne;

            $header .= "MIME-Version: 1.0" . $passage_ligne;

            $header .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;

//==========


//=====Création du message.

            $message = $passage_ligne . "--" . $boundary . $passage_ligne;

            //=====Ajout du message au format texte.

                    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;

                    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

                    $message.= $passage_ligne.$message_txt.$passage_ligne;

            //==========

                    $message.= $passage_ligne."--".$boundary.$passage_ligne;

//=====Ajout du message au format HTML

           /* $message .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $passage_ligne;

            $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;

            $message .= $passage_ligne . $message_html . $passage_ligne;*/

//==========

            $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;

            $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;

//==========


//=====Envoi de l'e-mail.

            if (mail($mail_contact, $sujet, $message, $header))
                ajaxSuccess($tab);
            else
                ajaxError("Non envoye", "NOT_SEND");
        }
        else
            ajaxError("Champs manquant", "MISSING_ARGUMENTS");
//==========
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