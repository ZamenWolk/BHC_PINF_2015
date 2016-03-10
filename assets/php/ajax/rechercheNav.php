<?php

include_once "../fonctions/fonctionsBDD.php";
include_once "../fonctions/AJAX.php";
include_once "../fonctions/fonctionRecherche.php";

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
            $i = 0;
            $tab = array();
            foreach ($tabMarque as $row) {
                $tab[$i] = $row[0];
                $i++;
            }
            $i=0;
            $tabCat1 = array();
            foreach ($tabCat as $row) {
                $tabCat1[$i] = $row[0];
                $i++;
            }
            $i=0;
            $tabLargeur1 = array();
            foreach ($tabLargeur as $row) {
                $tabLargeur1[$i] = $row[0];
                $i++;
            }
            $i=0;
            $tabCharge1 = array();
            foreach ($tabCharge as $row) {
                $tabCharge1[$i] = $row[0];
                $i++;
            }
            $i=0;
            $tabVitesse1 = array();
            foreach ($tabVitesse as $row) {
                $tabVitesse1[$i] = $row[0];
                $i++;
            }
            $i=0;
            $tabJante1 = array();
            foreach ($tabJante as $row) {
                $tabJante1[$i] = $row[0];
                $i++;
            }
            $i=0;
            $tabSerie1 = array();
            foreach ($tabSerie as $row) {
                $tabSerie1[$i] = $row[0];
                $i++;
            }
            $data["marques"] = $tab;
            $data["nbrMarque"] = count($tab);
            $data["categorie"] = $tabCat1;
            $data["nbrCategorie"] = count($tabCat1);
            $data["largeur"] = $tabLargeur1;
            $data["nbrLargeur"] = count($tabLargeur1);
            $data["charge"] = $tabCharge1;
            $data["nbrCharge"] = count($tabCharge1);
            $data["vitesse"] = $tabVitesse1;
            $data["nbrVitesse"] = count($tabVitesse1);
            $data["jante"] = $tabJante1;
            $data["nbrJante"] = count($tabJante1);
            $data["serie"] = $tabSerie1;
            $data["nbrSerie"] = count($tabSerie1);
            $data["success"] = 1;
            ajaxSuccess($data);
            break;
}


}



?>