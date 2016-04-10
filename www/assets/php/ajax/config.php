<?php

include_once "../../../secret/credentials.php";
include_once "../fonctions/AJAX.php";
include_once "../fonctions/Config.php";
include_once "../fonctions/fonctionsBDD.php";

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

/**
 * "setRatio"
 * Ajoute une entrée du ratio dans la base de donnée
 * Arguments :
 * [    "newRatio" => Nouveau ratio voulu ]
 * Aucun renvoi
 * Echoue si :
 *      - Le ratio n'est pas renseigné (code MISSING_ARGUMENT)
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

    case "setRatio" :

        if (!isset($_POST["newRatio"]))
            ajaxError("Le ratio n'est pas renseigné", "MISSING_ARGUMENT");

        $newRatio = $_POST["newRatio"];

        Config::setRatioPrix($newRatio);
        ajaxSuccess();

        break;

    default:
        ajaxError("Action inconnue");
}