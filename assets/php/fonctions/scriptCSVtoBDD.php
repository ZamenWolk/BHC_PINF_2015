<?php
include_once "../../../secret/credentials.php";
include_once "maLibSQL.pdo.php";
include_once "fonctionsBDD.php";
include_once "Recherche.php";


set_time_limit(1000);
$row = 1;
$time = time();
echo $time;
$fichier = "../../../secret/catpnhbonpneus.csv";
if(file_exists ($fichier)) {
    /*Module d'insertion dans la base*/
    if (($handle = fopen("../../../secret/catpnhbonpneus.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            if ($row%100 == 0)
                echo "Ligne $row<br />\n";
            $row++;/*
        for ($c=0; $c < $num; $c++) {
            echo "Champs".$c."  ".$data[$c] . "<br />\n";
        }*/
            if (!verifDescription($data[2], $data[5], $data[21]))//Ce n'est pas le même pneus //TODO: on doit verifier la description
            {
                $sql = "INSERT INTO pneu(pneu_ean, pneu_ref,
        pneu_marque, pneu_categorie,pneu_description,pneu_largeur,pneu_serie,pneu_jante,pneu_charge,pneu_vitesse,pneu_profil,pneu_decibel,
        pneu_bruit,pneu_consommation,pneu_adherance,pneu_categorieEtiquette,pneu_stock,pneu_prix,pneu_dateAjoutBDD,pneu_dateDerniereModif) VALUES (:ean,:ref,:marque,:categorie,
        :description,:largeur,:serie,:jante,:charge,:vitesse,:profil,:decibel,:bruit,:consommation,:adherance,:categorieEtiquette,:stock,:prix,:dateAjoutBDD,:dateDerniereModif)";

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
                    ":dateAjoutBDD" => $time,
                    ":dateDerniereModif" => $time
                ];
                // echo $sql;
                SQLInsert($sql, $param);

                /* On modifie les anciennes version */
                $sql2 = "UPDATE pneu SET pneu_valable=0, pneu_derniereVersion=0 WHERE pneu_ref=:ref AND pneu_dateAjoutBDD < :temps";
                $param = [
                    ":temps" => $time,
                    ":ref" => $data[2]
                ];
                //echo $sql1;
                $nbreUpdate = SQLUpdate($sql2, $param);
            } else {
                /*ICI on update a juste le stock et la date de modification*/
                $sql1 = "UPDATE pneu SET pneu_stock=:stock, pneu_dateDerniereModif=:temps WHERE pneu_dateAjoutBDD < :temps AND pneu_ref= :ref";
                $param = [
                    ":temps" => $time,
                    ":stock" => $data[20],
                    ":ref" => $data[2]
                ];
                SQLUpdate($sql1, $param);
            }
        }
        fclose($handle);
    }

    /*Permet de mettre en non valable les pneus supprimé du csv*/
    $sql = "UPDATE pneu SET pneu_valable=0 WHERE pneu_dateDerniereModif <" . $time . " AND pneu_derniereVersion=1";
    $nbreUpdate = SQLUpdate($sql);
    //unlink($fichier); // Supprime le fichier
}
?>