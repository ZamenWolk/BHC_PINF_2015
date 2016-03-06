<?php
include_once("../fonctions/AJAX.php");
include_once("../fonctions/Panier.php");

session_start();

if (!isset($_SESSION["panier"]))
    $_SESSION["panier"] = new Panier();

/**
 * TODO écrire la documentation
 */

$json = array();

if (!isset($_GET["action"]))
{
    $json["stat"] = "fail";
    $json["message"] = '"action" est vide';
    echo json_encode($json);
    die();
}

$action = $_GET["action"];

switch ($action)
{
    case "ajouterArticle":
        if (!isset($_GET["referencePneu"]))
            ajaxError('$_GET["referencePneu"] est vide');

        $referencePneu = $_GET["referencePneu"];

        $quantite = isset($_GET["quantite"]) ? $_GET["quantite"] : 1;

        if ($quantite < 1)
            ajaxError('La quantité à ajouter est negative ou nulle');

        $pneu = Pneu::getPneuFromDB($referencePneu);

        if ($pneu === false)
            ajaxError("Cette référence n'existe pas");

        $result = $_SESSION["panier"]->ajouterArticle($pneu, $quantite);

        if ($result === false)
            ajaxError("Erreur du fichier ajax, veuillez contacter l'administrateur réseau");

        ajaxSuccess(["reference" => $referencePneu, "quantite" => $quantite]);
        break;

}