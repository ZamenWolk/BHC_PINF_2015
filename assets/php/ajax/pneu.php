<?php
include_once("../fonctions/AJAX.php");
include_once("../fonctions/Pneu.php");

/**
 * Fichier utilisant la méthode "POST"
 * Actions possible :
 */

/**
 * "stockPneu"
 * Permet de récupérer le stock d'un pneu en BDD
 * Arguments :
 * [    "referencePneu" => Référence du pneu ]
 * Renvoi :
 * [    "referencePneu" => Référence du pneu,
 *      "stock"         => Stock du pneu en BDD ]
 * Echoue si :
 *      - La référence du pneu est vide                  (code MISSING_ARGUMENT)
 *      - Aucun pneu correspondant n'a été trouvé en BDD (code NO_CORRESPONDENCE)
 */

/**
 * "prixPneu"
 * Permet de récupérer le prix d'un pneu en BDD selon un ratio de prix à un temps donné
 * Arguments :
 * [    "referencePneu" => Référence du pneu,
 *      "dateAjoutBDD"  => Date d'ajout du pneu en BDD *facultatif, utilise le pneu valable avec référence donnée par défaut*,
 *      "ratioID"       => ID du ratio du prix utilisé pour calculer le prix *facultatif, dernier ratio en date par défaut* ]
 * Renvoi :
 * [    "referencePneu" => Référence du pneu,
 *      "stock"         => Stock du pneu en BDD ]
 * Echoue si :
 *      - La référence du pneu est vide                  (code MISSING_ARGUMENT)
 *      - Aucun pneu correspondant n'a été trouvé en BDD (code NO_CORRESPONDENCE)
 *      - Le ratio du prix n'a pas pu être trouvé        (code CANT_FIND_RATIO)
 */

if (!isset($_POST["action"]))
{
    ajaxError("Action non définie", "UNDEFINED_ACTION");
}

$action = $_POST["action"];

switch ($action)
{
    case "stockPneu":

        if (!isset($_POST["referencePneu"]))
            ajaxError('$_POST["referencePneu"] est vide', "MISSING_ARGUMENT");

        $referencePneu = $_POST["referencePneu"];

        $stock = Pneu::getStock($referencePneu);

        if ($stock === false)
            ajaxError("Aucun pneu correspondant n'a été trouvée", "NO_CORRESPONDENCE");
        else
        {
            $json = ["referencePneu" => $referencePneu, "stock" => $stock];

            ajaxSuccess($json);
        }

        break;

    case "prixPneu":
        if (!isset($_POST["referencePneu"]))
            ajaxError('$_POST["referencePneu"] est vide', "MISSING_ARGUMENT");

        $referencePneu = $_POST["referencePneu"];
        $dateAjoutBDD = (isset($_POST["dateAjoutBDD"]) ? $_POST["dateAjoutBDD"] : null);
        $IDratio = (isset($_POST["ratioID"]) ? $_POST["ratioID"] : null);

        $pneu = Pneu::getPneuFromDB($referencePneu, $dateAjoutBDD);

        if ($pneu === false)
            ajaxError("Aucun pneu correspondant n'a été trouvé", "NO_CORRESPONDENCE");

        $prix = $pneu->getPrix($IDratio);

        if ($prix === false)
            ajaxError("Ratio de prix non trouvé", "CANT_FIND_RATIO");

        $json = ["referencePneu" => $referencePneu, "prix" => $prix];

        if ($dateAjoutBDD != null)
            $json["dateAjoutBDD"] = $dateAjoutBDD;

        if ($IDratio != null)
            $json["ratioID"] = $IDratio;

        ajaxSuccess($json);

        break;

    default:
        ajaxError("Action inconnue", "UNKNOWN_ACTION");
}