<?php
include_once("../fonctions/AJAX.php");
include_once("../fonctions/Pneu.php");

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