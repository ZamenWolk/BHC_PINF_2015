<?php

include_once "../fonctions/fonctionsBDD.php";
include_once "../fonctions/AJAX.php";
include_once "../fonctions/fonctionRecherche.php";

if(isset($_POST["action"])) {
    $action = $_POST["action"];
    switch ($action) {
        case "chargement":
            $tab=array();
            $LesPneus = Recherche::rechercher($_POST['categorie'],$_POST['marque'], $_POST['largeur'], $_POST['serie'],$_POST['jante'],$_POST['charge'], $_POST['vitesse'],1);
            $data["sql"]= $lesPneus;
            if($data["sql"] != null)
                ajaxSuccess($data);
            else
                ajaxError("SQL=".$sql);
            die();
            break;
    }
}

ajaxError("Aucun paramétre défini");
?>