<?php

include_once "../../../secret/credentials.php";
include_once "../fonctions/fonctionsBDD.php";
include_once "../fonctions/AJAX.php";
include_once "../fonctions/Recherche.php";


/**
 * Fichier utilisant la méthode "action"
 * Actions possible :
 */

/**
 * "Chargement"
 * A l'aide des fonctions de recherche, récupère les marques, catégories, largeurs de pneus, charges, vitesse, jante, série, decibel et consommation ainsi que le nombre de chacune d'entre elles 
 * Arguments : 
 * [    "Aucun argument",	]
 * Renvoi :
 * [    "état" => #réussite# ]
 *
 */
if(isset($_POST["action"]))
{
    $action = $_POST["action"];
    switch($action) {
        case "chargement":

            $tabMarque = Recherche::rechercherMarque();
            $tabCat = Recherche::rechercherCategorie();
            $tabLargeur = Recherche::rechercherLargeur();
            $tabCharge = Recherche::rechercherCharge();
            $tabVitesse = Recherche::rechercherVitesse();
            $tabJante = Recherche::rechercherJante();
            $tabSerie= Recherche::rechercherSerie();
            $tabDecibel = Recherche::rechercherDecibel();
            $tabConso = Recherche::rechercherConsommation();

            $data["marques"] = $tabMarque;
            $data["nbrMarque"] = count($tabMarque);
            $data["categorie"] = $tabCat;
            $data["nbrCategorie"] = count($tabCat);
            $data["largeur"] = $tabLargeur;
            $data["nbrLargeur"] = count($tabLargeur);
            $data["charge"] = $tabCharge;
            $data["nbrCharge"] = count($tabCharge);
            $data["vitesse"] = $tabVitesse;
            $data["nbrVitesse"] = count($tabVitesse);
            $data["jante"] = $tabJante;
            $data["nbrJante"] = count($tabJante);
            $data["serie"] = $tabSerie;
            $data["nbrSerie"] = count($tabSerie);
            $data["decibel"] =  $tabDecibel;
            $data["nbrDecibel"] = count($tabDecibel);
            $data["consommation"] =$tabConso;
            $data["nbrConso"] = count($tabConso);
            ajaxSuccess($data);
            break;


	}
}

?>