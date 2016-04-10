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

/**
 * "changerEtat"
 * Change l'état d'une commande
 * Arguments :
 * [    "newEtat"       => Nouvel état de la commande,
 *      "commande_id"   => Identifiant de la commande ]
 * Aucun renvoi
 * Echoue si :
 *      - Il manque des arguments (code MISSING_ARGUMENT)
 *      - L'état entré n'est pas valide (code ETAT_INCONNU)
 *      - L'ID de commande renseigné ne correspond pas a une commande (code COMMANDE_INCONNUE)
 */

/**
 * "recupererCommande"
 * Récupère une commande ou une liste de commandes suivant un paramètre d'identification
 * Arguments :
 * [    "commande_id"   => ID de la commande à récupérer
 *          OU
 *      "user_id"       => ID de l'utilisateur dont on veut récupérer les commandes
 *          OU
 *      "etat"          => Etat dont on veut récupérer toutes les commandes ]
 * Renvoi :
 * [    "commandes" => Liste de toutes les commandes récupérées ]
 * Echoue si :
 *      - Il n'y a aucun paramètre d'identification (code MISSING_ARGUMENT)
 *      - Le paramètre est un ID de commande qui ne correspond à aucune commande
 *      - Le paramètre est un état invalide
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

        if (!isset($_POST["newEtat"]) || !isset($_POST["commande_id"]))
            ajaxError("Tous les arguments ne sont pas renseignés", "MISSING_ARGUMENT");

        $newEtat = $_POST["newEtat"];
        $commande_id = $_POST["commande_id"];

        if (!Commande::checkEtat($commande_id))
            ajaxError("L'état entré n'est pas un état valide", "ETAT_INCONNU");

        $res = Commande::changerEtat($commande_id, $newEtat);

        if ($res === false)
            ajaxError("Il n'y a pas de commande avec cet ID", "COMMANDE_INCONNUE");
        else
            ajaxSuccess();

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