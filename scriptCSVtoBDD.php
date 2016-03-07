<?php
include_once "secret/credentials.php";
include_once "assets/php/fonctions/maLibSQL.pdo.php";

set_time_limit(1000);
$row = 1;
$time = time();
echo $time;

/*Module d'insertion dans la base*/
if (($handle = fopen("secret/pneushollande.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
        echo "<p> $num champs à la ligne $row: <br /></p>\n";$row++;/*
        for ($c=0; $c < $num; $c++) {
            echo "Champs".$c."  ".$data[$c] . "<br />\n";
        }*/

        $sql="INSERT INTO jspneus.pneu(pneu_ean, pneu_ref,
pneu_marque, pneu_categorie,pneu_description,pneu_largeur,pneu_serie,pneu_jante,pneu_charge,pneu_vitesse,pneu_profil,pneu_decibel,
pneu_bruit,pneu_consommation,pneu_adherance,pneu_categorieEtiquette,pneu_stock,pneu_prix,pneu_dateAjoutBDD) VALUES (:ean,:ref,:marque,:categorie,
:description,:largeur,:serie,:jante,:charge,:vitesse,:profil,:decibel,:bruit,:consommation,:adherance,:categorieEtiquette,:stock,:prix,:dateAjoutBDD)";

        $param = [
        ":ean" => "$data[0]",
        ":ref" => "$data[2]",
        ":marque" => "$data[3]",
        ":categorie" => "$data[4]",
        ":description" => "$data[5]",
        ":largeur" => "$data[6]",
        ":serie" => "$data[7]",
        ":jante" => "$data[8]",
        ":charge" => "$data[9]",
        ":vitesse" => "$data[10]",
        ":profil" => "$data[12]",
        ":decibel" => "$data[15]",
        ":bruit" => "$data[16]",
        ":consommation" => "$data[17]",
        ":adherance" => "$data[18]",
        ":categorieEtiquette" => "$data[19]",
        ":stock" => $data[20],
        ":prix" => $data[21],
        ":dateAjoutBDD" => $time
        ];
       // echo $sql;
        SQLInsert($sql, $param);

        $sql1="UPDATE jspneus.pneu SET pneu_valable=0, pneu_derniereVersion=0 WHERE pneu_dateAjoutBDD < :temps AND pneu_ref= :ref";
        $param = [
            ":temps" => $time,
            ":ref" => $data[2]
        ];
        //echo $sql1;
        $nbreUpdate = SQLUpdate($sql1, $param);

    }
    fclose($handle);
}

/*Permet de mettre en non valable les pneus supprimé du csv*/
$sql="UPDATE pneu SET pneu_valable=0 WHERE pneu_dateAjoutBDD <".$time." AND pneu_derniereVersion=1";
$nbreUpdate = SQLUpdate($sql);
echo $nbreUpdate;
set_time_limit(120);
?>