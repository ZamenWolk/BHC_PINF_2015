<?php
include_once("../fonctions/AJAX.php");
include_once("../fonctions/Panier.php");

session_start();

if (!isset($_SESSION["panier"]))
    $_SESSION["panier"] = new Panier();

$panier = $_SESSION["panier"];
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
    case "vider":

        $panier->vider();
        ajaxSuccess(["vide" => true]);

        break;

    case "nbArticles":

        ajaxSuccess(["nbArticles" => $panier->nbArticles()]);

        break;

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

        $result = $panier->ajouterArticle($pneu, $quantite);

        if ($result === false)
            ajaxError("Erreur du fichier ajax, veuillez contacter l'administrateur réseau");

        ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);

        break;

    case "retirerArticle":

        if (!isset($_GET["referencePneu"]))
            ajaxError('$_GET["referencePneu"] est vide');

        $referencePneu = $_GET["referencePneu"];

        $result = $panier->retirerArticle($referencePneu);

        if ($result)
            ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);
        else
            ajaxWarning("La référence n'était pas présente dans le panier", ["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);

        break;

    case "ajouterQuantite":

        if (!isset($_GET["referencePneu"]))
            ajaxError('$_GET["referencePneu"] est vide');

        $referencePneu = $_GET["referencePneu"];
        $quantite = isset($_GET["quantite"]) ? $_GET["quantite"] : 1;

        if ($quantite < 0)
            ajaxError('La quantité à ajouter est negative');

        $result = $panier->ajouterQuantite($referencePneu, $quantite);

        if ($result)
            ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);
        else
            ajaxError("La référence n'est pas présente dans le panier");

        break;

    case "retirerQuantite":

        if (!isset($_GET["referencePneu"]))
            ajaxError('$_GET["referencePneu"] est vide');

        $referencePneu = $_GET["referencePneu"];
        $quantite = isset($_GET["quantite"]) ? $_GET["quantite"] : 1;

        if ($quantite < 0)
            ajaxError('La quantité à retirer est negative');

        $result = $panier->retirerQuantite($referencePneu, $quantite);

        if ($result)
            ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);
        else
            ajaxError("La référence n'est pas présente dans le panier");

        break;

    case "changerQuantite":

        if (!isset($_GET["referencePneu"]))
            ajaxError('$_GET["referencePneu"] est vide');

        $referencePneu = $_GET["referencePneu"];
        $quantite = isset($_GET["quantite"]) ? $_GET["quantite"] : 1;

        if ($quantite < 0)
            ajaxError('La nouvelle quantité est negative');

        $result = $panier->changerQuantite($referencePneu, $quantite);

        if ($result)
            ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);
        else
            ajaxError("La référence n'est pas présente dans le panier");

        break;

    case "prixLot":

        if (!isset($_GET["referencePneu"]))
            ajaxError('$_GET["referencePneu"] est vide');

        $referencePneu = $_GET["referencePneu"];

        ajaxSuccess(["referencePneu" => $referencePneu, "prixLot" => $panier->prixArticle($referencePneu)]);

        break;

    case "contenuPanier":

        ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);

        break;

    default :
        ajaxError("Action unknown");
}