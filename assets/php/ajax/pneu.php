<?php
include_once("../fonctions/AJAX.php");
include_once("../fonctions/Pneu.php");

if (!isset($_GET["action"]))
{
    ajaxError("Action non définie");
}

$action = $_GET["action"];

switch ($action)
{
    case "stockPneu":

        if (!isset($_GET["referencePneu"]))
            ajaxError('$_GET["referencePneu"] est vide');

        $referencePneu = $_GET["referencePneu"];

        $dateAjoutBDD = (isset($_GET["dateAjoutBDD"]) ? $_GET["dateAjoutBDD"] : null);

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