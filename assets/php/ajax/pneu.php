<?php
include_once("../fonctions/AJAX.php");
include_once("../fonctions/Pneu.php");

/**
 * Fichier utilisant la méthode "POST"
 * Actions possible :
 *
 * "stockPneu"
 * Permet de récupérer le stock d'un pneu en BDD
 * Arguments :
 * [    "referencePneu" => Référence du pneu,
 *      "dateAjoutBDD"  => Date d'ajout du pneu en BDD *optionnel, cherche un pneu valable par défaut*]
 * Renvoi :
 * [    "referencePneu" => Référence du pneu,
 *      "dateAjoutBDD"  => Date d'ajout du pneu en BDD *absent si l'argument "dateAjoutBDD" n'a pas été précisé*,
 *      "stock"         => Stock du pneu en BDD ]
 * Echoue si :
 *      - La référence du pneu est vide
 *      - La référence n'existe pas en BDD
 */

if (!isset($_POST["action"]))
{
    ajaxError("Action non définie");
}

$action = $_POST["action"];

switch ($action)
{
    case "stockPneu":

        if (!isset($_POST["referencePneu"]))
            ajaxError('$_POST["referencePneu"] est vide');

        $referencePneu = $_POST["referencePneu"];

        $dateAjoutBDD = (isset($_POST["dateAjoutBDD"]) ? $_POST["dateAjoutBDD"] : null);

        $stock = Pneu::getStock($referencePneu, $dateAjoutBDD);

        if ($stock === false)
            ajaxError("Cette référence n'a pas été trouvée");
        else
        {
            $json = ["referencePneu" => $referencePneu, "stock" => $stock];

            if ($dateAjoutBDD !== null)
                $json["dateAjoutBDD"] = $dateAjoutBDD;

            ajaxSuccess($json);
        }

        break;

    default:
        ajaxError("Action inconnue");
}