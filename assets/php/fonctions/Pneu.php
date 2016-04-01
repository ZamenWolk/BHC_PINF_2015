<?php
if (file_exists("../../../secret/credentials.php"))
    include_once("../../../secret/credentials.php");
if (file_exists("../fonctions/maLibSQL.pdo.php"))
    include_once "../fonctions/maLibSQL.pdo.php";
if (file_exists("../fonctions/Config.php"))
    include_once "../fonctions/Config.php";

class Pneu
{
	/**
	*  
	* @brief Crée un nouveau pneu
	* @param Pneu pneu Le pneu et les informations que l'on veut placer sur le nouveau pneu
	*
	**/
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

	/**
	*  
	* @brief Récupère un pneu par sa référence et date d'ajout si elle est spécifiée
	* @param string reference Référence du pneu que l'on veut récupérer
	* @param string dateAjoutBDD Date d'ajout en BDD du pneu si le pneu vient a changé au cours du temps
	* @return boolean|pneus False si le pneu correspond à false en tout point, le pneus que l'on a récupéré
	*
	**/
    public static function getPneuFromDB($reference, $dateAjoutBDD = null)
    {
        $sql = "SELECT * FROM pneu WHERE pneu_ref=:ref";
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

	/**
	*  
	* @brief Récupère le stock d'un pneu passé paramètre 
	* @param string reference Référence du pneu dont on veut récupérer le stock
	* @param string dateAjoutBDD Date d'ajout en BDD du stock si le stock vient a changé au cours du temps
	* @return boolean|pneus False si le pneu correspond à false en tout point, le stock que l'on a récupéré
	*
	**/
    public static function getStock($reference, $dateAjoutBDD = null)
    {
        $pneu = Pneu::getPneuFromDB($reference, $dateAjoutBDD);

        if ($pneu === false)
            return false;
        else
            return $pneu->stock;
    }

	/**
	*  
	* @brief Récupère le prix d'un pneu
	* @param float ratioID le ratio de prix que JSPneus applique sur les pneus pour la marge de bénéfice
	* @return boolean|float False si il n'y a pas de ratio de prix, prix avec coefficient et arrondi à la 2eme décimale
	*
	**/
    public function getPrix($ratioID = null)
    {
        if (Config::getRatioPrix($ratioID) === false)
            return false;
        return round($this->prix * Config::getRatioPrix($ratioID), 2);
    }

	/**
	*  
	* @brief Récupère un pneu 
	* @return pneu Pneu que l'on a récupéré
	*
	**/
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