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
 * "#action1#"
 * #description de l'action#
 * Arguments : #Remplacer bloc par "Aucun argument si pas d'arguments#
 * [    "#agument1#" => #Description de l'argument#,
 *      "#agument2#" => #Description de l'argument# ]
 * Renvoi :
 * [    "#renvoi1#" => #Description du renvoi#,
 *      "#renvoi2#" => #Description du renvoi# ]
 * Avertit si : #Supprimer ce bloc si jamais d'avertissement#
 *      - #Cause d'avertissement 1# (code #code d'avertissement#)
 *      - #Cause d'avertissement 2# (code #code d'avertissement#)
 * Echoue si : #Supprimer ce bloc si jamais d'erreur#
 *      - #Cause d'erreur 1# (code #code d'erreur#)
 *      - #Cause d'erreur 2# (code #code d'erreur#)
 *
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

        break;

    case "recupererCommande" :
        
        

        break;
    
    default:
        ajaxError("Action inconnue");
}