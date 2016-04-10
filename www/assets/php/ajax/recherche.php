<?php

include_once "../../../secret/credentials.php";
include_once "../fonctions/fonctionsBDD.php";
include_once "../fonctions/AJAX.php";
include_once "../fonctions/Recherche.php";



/**
 * "chargement"
 * action qui permet de charger une liste de pneus selon différents critères
 * Arguments :
 * [    "categorie" => catégorie recherché,
 *      "marque" => Marque recherché,
 *      "largeur" =>largeur recherché,
 *      "serie" => #Description de l'argument#,
 *      "jante" => #Description de l'argument#,
 *      "charge" => #Description de l'argument#,
 *      "vitesse" => #Description de l'argument#,
 *      "consommation" => #Description de l'argument#,
 *      "decibel" => #Description de l'argument#,
 *      "numeroPage" => Définie la page à laquelle tu est si plus de itemParPage à mettre à 1 si il n'y a qu'un résultat,
 *      "categorie" => définie le type de tri : 0 : tri par marque
 *                                              1 : tri par prix ascendant
 *                                              2 : tri par prix descendant
 *                                              default : pas de order by dans la requête,]
 * Renvoi :
 * [    "resultat" => Tableau de pneus e JSON à convertir en objet avec JSON.parse en Jquery,
 *      "nbrResult" =>Nombre de résultat de la requète obtenu ]
 *
 */


/**
 * "chargementRef"
 * Action qui permet de charger un pneus selon sa réference
 * Arguments :
 * [
 *      "ref" : reférence du pneu]
 * Renvoi :
 * [    "resultat" => Renvoie un tableau contenant les différentes informations en JSON --> JSON.parse à utiliser
 *      "nbrResult" =>Nombre de résultat de la requète obtenu ]
 *
 * Echec :
 * [
 *      "message" : "erreur" Si pas de pneu valide correspondant à cette référence
 * ]
 */
if(isset($_POST["action"])) {
    $action = $_POST["action"];
    switch ($action) {
        /**
         * Chargement des penus par ajax, attention il manque la pagination, commentaires en cours de réalisation
         */
        case "chargement":
            $tab=array();
            $LesPneus = Recherche::rechercher($_POST['categorie'],$_POST['marque'], $_POST['largeur'], $_POST['serie'],
                $_POST['jante'],$_POST['charge'], $_POST['vitesse'],$_POST['consommation'],$_POST ['decibel'],$_POST["numeroPage"],$_POST["itemParPage"],$_POST['order']);
            $tab['nbrResult'] = count($LesPneus);
            if($tab['nbrResult']  >0 )
                $tab["resultat"] = $LesPneus;
            else {
                $tab["resultat"] = null;
            }
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