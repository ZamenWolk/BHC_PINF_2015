<?php

include_once "../fonctions/Adresse.php";
include_once "../fonctions/AJAX.php";
include_once "../../../secret/credentials.php";


if(isset($_POST["action"]))
    $action = $_POST["action"];
else
    $action = "default";

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

/**
 * "setAdresse"
 * #Modifie l'adresse soit à partir de l'id_user soit à partir de l'id d'une adresse, priorité sur l'id adresse#
 * Arguments : #Remplacer bloc par "Aucun argument si pas d'arguments#
 * [    "adresse_ligne1" => #Adresse ligne 1#,
 *      "adresse_ligne2" => #Complément d'adresse#,
 *      "adresse_codeP" => #Nouveau code Postal#,
 *      "adresse_ville" => #Nouvelle ville#,
 *      "user_id" => #ID de l'utilisateur dont l'adresse doit être modifié#,
 *      "adresse_id" => #ID de l'adresse à modifier#]
 * Renvoi :
 * [    "etat" => #réussi ou échec#]
 * Echoue si : #Supprimer ce bloc si jamais d'erreur#
 *      - #Pas de user_id et pas de adresse_id# (code #NO_ID#)
 *      - #Pas tous les champs a modifier transmis# (code #MISSING_ARGUMENTS#)
 *
 */
switch($action){
    case "inscrireAdresse":
        if(isset($_POST["adresse_ligne1"]) && isset($_POST["adresse_ligne2"]) && isset($_POST["adresse_codeP"]) && isset($_POST["adresse_ville"]) && isset($_POST["user_id"])) {
            $res = Adress::mkAdresse($_POST["adresse_ligne1"], $_POST["adresse_ligne2"], $_POST["adresse_codeP"], $_POST["adresse_ville"], $_POST["user_id"]);
            if ($res == false)
                ajaxError("Pas d'inscription de l'adresse");
            $tab["msg"] = "Adresse ajoutée";
            ajaxSuccess($tab);
        }
        else
            ajaxError("Champs manquant adresse");
        break;
    case "getAdresse":
        if(isset($_POST["user_id"])) {
            $res = Adress::getAdresse($_POST["user_id"]);
            $tab["adresse"] = $res["0"];
            ajaxSuccess($tab);
        }
        else
            ajaxError("Pas d'user_id", "NO_ID");

        break;
    case "setAdresse":
        if(isset($_POST["adresse_id"])) {
            if (isset($_POST["adresse_ligne1"]) && isset($_POST["adresse_ligne2"]) && isset($_POST["adresse_codeP"]) && isset($_POST["adresse_ville"])) {
                Adress::setAdresseByIdAdresse($_POST["adresse_ligne1"], $_POST["adresse_ligne2"], $_POST["adresse_codeP"], $_POST["adresse_ville"], $_POST["adresse_id"]);
                ajaxSuccess(array("succes" =>1));
            }
            else
                ajaxError("Erreur", "MISSING_ARGUMENTS");
        }
        if(isset($_POST["user_id"]))
        {
            if (isset($_POST["adresse_ligne1"]) && isset($_POST["adresse_ligne2"]) && isset($_POST["adresse_codeP"]) && isset($_POST["adresse_ville"])) {
                Adress::setAdresse($_POST["adresse_ligne1"], $_POST["adresse_ligne2"], $_POST["adresse_codeP"], $_POST["adresse_ville"], $_POST["user_id"]);
                ajaxSuccess(array("succes" =>1));
            }
            else
                ajaxError("Erreur", "MISSING_ARGUMENTS");
        }
        ajaxError("Erreur","NO_ID");
            break;
    default:
        break;

}



?>