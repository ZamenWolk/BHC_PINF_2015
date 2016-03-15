<?php

include_once "../fonctions/fonctionsBDD.php";
include_once "../fonctions/AJAX.php";
include_once "../fonctions/Recherche.php";

if(isset($_POST["action"])) {
    $action = $_POST["action"];
    switch ($action) {
        /**
         * Chargement des penus par ajax, attention il manque la pagination, commentaires en cours de réalisation
         */
        case "chargement":
            $tab=array();
            $LesPneus = Recherche::rechercher($_POST['categorie'],$_POST['marque'], $_POST['largeur'], $_POST['serie'],
                $_POST['jante'],$_POST['charge'], $_POST['vitesse'],$_POST["numeroPage"],25,$_POST['order']);
            $tab['nbrResult'] = count($LesPneus);
            if($tab['nbrResult']  >0 )
                $tab["resultat"] = $LesPneus;
            else
                $tab["resultat"]=null;
            //TODO: Rajouter un cas en cas d'echec d'accés à la bdd par exemple avec ajaxError

            ajaxSuccess($tab);
            die();
            break;
        case "chargementRef":
            $tab=array();
            $lePneus= Recherche::rechercherPneu($_POST["ref"]);
            $tab["resultat"] = $lePneus;
            $tab["nbrResult"] = count($tab["resultat"]);
            if($tab["nbrResult"]==1)
            {
                ajaxSuccess($tab);
            }
            else
                ajaxError("erreur");
            die();
            break;
    }
}

ajaxError("Aucun paramétre défini");
?>