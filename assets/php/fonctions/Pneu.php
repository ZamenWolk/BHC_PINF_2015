<?php
if (file_exists("../../../secret/credentials.php"))
    include_once("../../../secret/credentials.php");
if (file_exists("maLibSQL.pdo.php"))
    include_once "maLibSQL.pdo.php";

class Pneu
{
    public function Pneu($pneu)
    {
        $this->EAN = $pneu["pneu_ean"];
        $this->reference = $pneu["pneu_ref"];
        $this->marque = $pneu["pneu_marque"];
        $this->categorie = $pneu["pneu_categorie"];
        $this->description = $pneu["pneu_description"];
        $this->largeur = $pneu["pneu_largeur"];
        $this->serie = $pneu["pneu_serie"];
        $this->jante = $pneu["pneu_jante"];
        $this->charge = $pneu["pneu_charge"];
        $this->vitesse = $pneu["pneu_vitesse"];
        $this->profil = $pneu["pneu_profil"];
        $this->decibel = $pneu["pneu_decibel"];
        $this->bruit = $pneu["pneu_bruit"];
        $this->consommation = $pneu["pneu_consommation"];
        $this->adherance = $pneu["pneu_adherance"];
        $this->categorieEtiquette = $pneu["pneu_categorieEtiquette"];
        $this->stock = $pneu["pneu_stock"];
        $this->prix = $pneu["pneu_prix"];
        $this->dateAjoutBDD = $pneu["pneu_dateAjoutBDD"];
    }

    public static function getPneuFromDB($reference, $dateAjoutBDD = null)
    {
        $sql = "SELECT * FROM jspneus.pneu WHERE pneu_ref=:ref";
        $param = array(":ref" => $reference);

        if ($dateAjoutBDD == null)
        {
            $sql .= " AND pneu_valable=1";
        }
        else
        {
            $sql .= " AND pneu_dateAjoutBDD=:dateAjout";
            $param[":dateAjout"] = $dateAjoutBDD;
        }

        $pneus = SQLSelect($sql, $param);

        if ($pneus === false)
            return false;
        else
            return new Pneu($pneus[0]);
    }

    //TODO Peut-être modifier cette fonction pour afficher le stock suivant les commandes précédantes ?
    public static function getStock($reference, $dateAjoutBDD = null)
    {
        $pneu = Pneu::getPneuFromDB($reference, $dateAjoutBDD);

        if ($pneu === false)
            return false;
        else
            return $pneu->stock;
    }

    public function getPrix($ratioID = null)
    {
        if (Config::getRatioPrix($ratioID) === false)
            return false;
        return $this->prix * Config::getRatioPrix($ratioID);
    }

    public function getPneu()
    {
        $pneu = array();

        $pneu["EAN"] = $this->EAN;
        $pneu["reference"] = $this->reference;
        $pneu["marque"] = $this->marque;
        $pneu["categorie"] = $this->categorie;
        $pneu["description"] = $this->description;
        $pneu["largeur"] = $this->largeur;
        $pneu["serie"] = $this->serie;
        $pneu["jante"] = $this->jante;
        $pneu["charge"] = $this->charge;
        $pneu["vitesse"] = $this->vitesse;
        $pneu["profil"] = $this->profil;
        $pneu["decibel"] = $this->decibel;
        $pneu["bruit"] = $this->bruit;
        $pneu["consommation"] = $this->consommation;
        $pneu["adherance"] = $this->adherance;
        $pneu["categorieEtiquette"] = $this->categorieEtiquette;
        $pneu["stock"] = $this->stock;

        return $pneu;
    }

    public $EAN;
    public $reference;
    public $marque;
    public $categorie;
    public $description;
    public $largeur;
    public $serie;
    public $jante;
    public $charge;
    public $vitesse;
    public $profil;
    public $decibel;
    public $bruit;
    public $consommation;
    public $adherance;
    public $categorieEtiquette;
    public $stock;
    public $prix;
    public $dateAjoutBDD;
}