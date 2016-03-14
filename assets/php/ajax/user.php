<?php

include_once("../fonctions/AJAX.php");
include_once("../fonctions/User.php");

session_start();

if (!isset($_POST["action"]))
{
    ajaxError("Action non définie");
}

$action = $_POST["action"];

switch ($action)
{
    case "connecter":

        break;

    case "deconnecter":

        break;

    case "inscrire":

        break;

    case "getUser":

        break;

    case "changerInformations":

        break;

    case "changePassword":

        break;

    default:
        ajaxError("Action inconnue");
}