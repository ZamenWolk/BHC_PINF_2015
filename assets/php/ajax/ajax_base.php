<?php

/**
 * Fichier utilisant la méthode "#methode utilisée#"
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
    default:
        ajaxError("Action inconnue");
}