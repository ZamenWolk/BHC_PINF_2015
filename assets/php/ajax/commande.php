<?php

include_once "../../../secret/credentials.php";
include_once "../fonctions/fonctionsBDD.php";
include_once "../fonctions/Commande.php";
include_once "../fonctions/Config.php";

/**
 * Fichier utilisant la méthode "POST"
 * Actions possible :
 */

/**
 * "creerCommande"
 * Créée une commande en BDD suivant les variables lancées par l'utilisateur
 * Arguments :
 * [    "id_adresse_facturation"    => ID de l'adresse de facturation,
 *      "id_adresse_livraison"      => ID de l'adresse de livraison,
 *      "panier"                    => Liste de produits en BDD (tel que renvoyé par l'ajax contenuPanier) ]
 * Renvoi :
 * [    "commande_id" => ID de la commande créée ]
 * Echoue si :
 *      - Il manque des paramètres (code MISSING_ARGUMENT)
 */



if (!isset($_POST["action"]))
{
    ajaxError("Action non définie");
}

$action = $_POST["action"];

switch ($action)
{
    case "creerCommande" :

        if (!isset($_POST["id_adresse_facturation"]) || !isset($_POST["id_adresse_livraison"]) || !isset($_POST["panier"]))
            ajaxError("Tous les paramètres obligatoires ne sont pas renseignés", "MISSING_ARGUMENT");

        $facturation = $_POST["id_adresse_facturation"];
        $livraison = $_POST["id_adresse_livraison"];
        $etat = isset($_POST["etatCommande"]) ? $_POST["etatCommande"] : "NON_TRAITE";
        $panier = $_POST["panier"];

        $commande = Commande::getCommandeFromData(time(), Config::getLastConfigDate(), $facturation, $livraison, $etat);
        $commande->setProduits($panier);
        
        $res = $commande->inscrireEnBDD();
        
        ajaxSuccess(["commande_id" => $res]);

        break;

    case "changerEtat" :

        if (!isset($_POST["newEtat"]))

        break;

    case "recupererCommande" :
        
        if (!isset($_POST["commande_id"]) && !isset($_POST["user_id"]) && !isset($_POST["etat"]))
            ajaxError("Il n'y a aucun paramètre d'identification", "MISSING_ARGUMENT");

        $commande_id = isset($_POST["commande_id"]) ? $_POST["commande_id"] : null;
        $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;
        $etat = isset($_POST["etat"]) ? $_POST["etat"] : null;

        $commandeTxt = array();

        if (isset($commande_id))
        {
            $res = SQLSelect("SElECT * FROM commande WHERE commande_id = ?", [$commande_id]);

            if ($res === false)
                ajaxError("Il n'y a pas de commande avec cet ID");

            $commandes = [new Commande($res[0])];

            $commandeTxt = [$commandes[0]->getCommande()];
        }
        else if (isset($user_id))
        {
            $commandes = Commande::loadCommandeFromUserID($user_id);

            foreach ($commandes as $item)
            {
                array_push($commandeTxt, $item->getCommande());
            }
        }
        else
        {
            $commandes = Commande::loadCommandeFromEtat($etat);

            if ($commandes === false)
                ajaxError("L'état envoyé n'est pas un état valide", "ETAT_INCORRECT");

            foreach ($commandes as $item)
            {
                array_push($commandeTxt, $item->getCommande());
            }
        }

        ajaxSuccess(["commandes" => $commandeTxt]);

        break;
    
    default:
        ajaxError("Action inconnue");
}