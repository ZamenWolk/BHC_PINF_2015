<?php

include_once "../fonctions/Adresse.php";
include_once "../fonctions/AJAX.php";
include_once "../../../secret/credentials.php";


if(isset($_POST["action"]))
    $action = $_POST["action"];
else
    $action = "default";

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
            ajaxSuccess($res);
        }
        else
            ajaxError("Pas d'user_id", "NO_ID");

        break;
    case "setAdresse":

        break;
    default:
        break;

}



?>