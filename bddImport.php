<?php

include_once("secret/credentials.php");
include_once("assets/php/fonctions/maLibSQL.pdo.php");

global $BDD_host;
global $BDD_base;
global $BDD_user;
global $BDD_password;

$time = time();

try {
    $dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base;charset=UTF8", $BDD_user, $BDD_password);
} catch (PDOException $e) {
    die("<font color=\"red\">SQLUpdate/Delete: Erreur de connexion : " . $e->getMessage() . "</font>");
}

$handle = fopen("pneushollande.csv", "r");
if ($handle)
{
    $nb = 0;
    while (($line = fgets($handle)) !== false)
    {
        $nb++;
        $lineArray = explode(";", $line);
        $param = array();

        foreach($lineArray as $key=>$item)
        {
            $lineArray[$key] = str_replace('"', '', $lineArray[$key]);
            $lineArray[$key] = str_replace("\r", '', $lineArray[$key]);
            $lineArray[$key] = str_replace("\n", '', $lineArray[$key]);

            if ($key != 1 && $key != 11 && $key != 13 && $key != 14)
            array_push($param, $lineArray[$key]);
        }

        array_push($param, $time);

        $req = "INSERT INTO jspneus.pneu(pneu_ean, pneu_ref, pneu_marque, pneu_categorie, pneu_description, pneu_largeur, pneu_serie, pneu_jante, pneu_charge, pneu_vitesse, pneu_profil, pneu_decibel, pneu_bruit, pneu_consommation, pneu_adherance, pneu_categorieEtiquette, pneu_stock, pneu_prix, pneu_dateAjoutBDD)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        if ($nb%100 == 0)
            echo "Ligne " . $nb . "\n";


        SQLInsert($req, $param);
    }

    fclose($handle);
} else {
    die("Can't open file");
}