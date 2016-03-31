<?php

include_once "../fonctions/AJAX.php";
include_once "../fonctions/Config.php";

/**
 * Fichier utilisant la méthode "POST"
 * Actions possible :
 */

/**
 * "getRatio"
 * Renvoie le ratio actuel de prix, ou le prix associé à un temps donné
 * Arguments :
 * [    "ratioID" => ID du ratio *facultatif, renvoie le dernier ratio par défaut* ]
 * Renvoi :
 * [    "ratio" => Le ratio demandé ]
 */

if (!isset($_POST["action"]))
{
    ajaxError("Action non définie");
}

$action = $_POST["action"];

switch ($action)
{
    case "getRatio" :

        $ratioID = isset($_POST["ratioID"]) ? $_POST["ratioID"] : null;
        ajaxSuccess(["ratio" => Config::getRatioPrix($ratioID)]);

        break;

    default:
        ajaxError("Action inconnue");
}