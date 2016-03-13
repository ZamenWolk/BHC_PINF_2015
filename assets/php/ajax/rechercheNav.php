<?php

include_once "../fonctions/fonctionsBDD.php";
include_once "../fonctions/AJAX.php";
include_once "../fonctions/Recherche.php";

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
            //$data["success"] = 1;
            ajaxSuccess($data);
            break;


}


}



?>