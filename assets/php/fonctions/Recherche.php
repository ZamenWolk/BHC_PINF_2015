<?php


include_once("../fonctions/Pneu.php");
include_once "../fonctions/maLibSQL.pdo.php";



class Recherche{
    /**
	* @brief Recherche toutes les marques disponibles
	* @return array tab Le tableau avec toutes les marques
	*
	**/
    public static function rechercherMarque()
    {
        $sql="SELECT DISTINCT pneu_marque FROM pneu ORDER BY pneu_marque ASC";
        $res = SQLSelect($sql, array());
        $tab = array();

        foreach($res as $row)
        {
            array_push($tab, $row["pneu_marque"]);
        }
        return $tab;
    }

    /**
	* @brief Recherche toutes les catégories disponibles
	* @return array tab Le tableau avec toutes les catégories
	*
	**/
    public static function rechercherCategorie()
    {
        $sql="SELECT DISTINCT pneu_categorie FROM pneu ORDER BY pneu_categorie ASC";
        $res = SQLSelect($sql, array());
        $tab = array();

        foreach($res as $row)
        {
            array_push($tab, $row["pneu_categorie"]);
        }
        return $tab;
    }
    /**
	* @brief Recherche toutes les largeurs disponibles
	* @return array tab Le tableau avec toutes les largeurs
	*
	**/
    public static function rechercherLargeur()
        {
            $sql="SELECT DISTINCT pneu_largeur FROM pneu ORDER BY pneu_largeur ASC";
            $res = SQLSelect($sql, array());
            $tab = array();

            foreach($res as $row)
            {
                array_push($tab, $row["pneu_largeur"]);
            }
            return $tab;
        }

    /**
	* @brief Recherche toutes les jantes disponibles
	* @return array tab Le tableau avec toutes les jantes
	*
	**/
    public static function rechercherJante()
        {
            $sql="SELECT DISTINCT pneu_jante FROM pneu ORDER BY  pneu_jante ASC";
            $res = SQLSelect($sql, array());
            $tab = array();

            foreach($res as $row)
            {
                array_push($tab, $row["pneu_jante"]);
            }
            return $tab;
        }

    /**
	* @brief Recherche toutes les charges disponibles
	* @return array tab Le tableau avec toutes les charges
	*
	**/
    public static function rechercherCharge()
        {
            $sql="SELECT DISTINCT pneu_charge FROM pneu ORDER BY pneu_charge ASC";
            $res = SQLSelect($sql, array());
            $tab = array();

            foreach($res as $row)
            {
                array_push($tab, $row["pneu_charge"]);
            }
            return $tab;
        }

    /**
	* @brief Recherche toutes les vitesses disponibles
	* @return array tab Le tableau avec toutes les vitesses
	*
	**/
    public static function rechercherVitesse()
        {
            $sql="SELECT DISTINCT pneu_vitesse FROM pneu ORDER BY pneu_vitesse ASC";
            $res = SQLSelect($sql, array());
            $tab = array();

            foreach($res as $row)
            {
                array_push($tab, $row["pneu_vitesse"]);
            }
            return $tab;
        }

   /**
	* @brief Recherche tout les decibels disponibles
	* @return array tab Le tableau avec tout les decibels 
	*
	**/
    public static function rechercherDecibel()
    {
        $sql="SELECT DISTINCT pneu_decibel FROM pneu ORDER BY pneu_vitesse ASC";
        $res = SQLSelect($sql, array());
        $tab = array();

        foreach($res as $row)
        {
            array_push($tab, $row["pneu_decibel"]);
        }
        return $tab;
    }
    
	/**
	* @brief Recherche toutes les consommations disponibles
	* @return array tab Le tableau avec toutes les consommations
	*
	**/
    public static function rechercherConsommation()
    {
        $sql="SELECT DISTINCT pneu_consommation FROM pneu ORDER BY pneu_consommation ASC";
        $res = SQLSelect($sql, array());
        $tab = array();

        foreach($res as $row)
        {
            array_push($tab, $row["pneu_consommation"]);
        }
        return $tab;
    }
	
    /**
	* @brief Recherche toutes les séries disponibles
	* @return array tab Le tableau avec toutes les séries
	*
	**/
    public static function rechercherSerie()
    {
        $sql="SELECT DISTINCT pneu_serie FROM pneu ORDER BY pneu_serie ASC";
        $res = SQLSelect($sql, array());
        $tab = array();

        foreach($res as $row)
        {
            array_push($tab, $row["pneu_serie"]);
        }
        return $tab;
    }

	/**
	* @brief Rechercher un pneu par sa référence
	* @param string ref Référence du pneu que l'on cherche
	* @return array tab Tableau contenant les informations liées au pneu qu'on a trouvé
	*
	**/
    public static function rechercherPneu($ref){
        $sql ="SELECT * FROM pneu WHERE pneu_ref=:ref AND pneu_valable=1";
        $param = array();
        $param[":ref"]=$ref;
        $res = SQLSelect($sql, $param);
        $tab  = array();
        if($res != null) {
            foreach ($res as $row) {
                array_push($tab, $row);
            }
        }
        else
            array_push($tab,"Pas de résultat");
        return $tab;
    }

/**
	* @brief Rechercher un pneu avec différents paramètres
	* @param string cat Catégorie du pneu
	* @param string marque Marque du pneu 
	* @param float largeur Largeur du pneu
	* @param string serie Série du pneu
	* @param float charge Charge du pneu
	* @param float vitesse Vitesse du pneu
	* @param string consommation Consommation du pneu
	* @param float decibel Decibel du pneu
	* @return array tab Tableau contenant les informations liées au pneu qu'on a recherché
	*
	**/
    public static function rechercher($cat, $marque, $largeur, $serie, $jante, $charge,$vitesse,$consommation,$decibel,$numeroPage, $itemParPage,$order = 0)
    {
        $sql = "SELECT * FROM pneu WHERE pneu_valable=1";
        $param = array();
        if($cat != "0")
        {
            $sql .= " AND pneu_categorie=:categorie";
            $param[":categorie"] = $cat;
        }
        if($marque != "0")
        {
            $sql .= " AND pneu_marque=:marque";
            $param[":marque"] = $marque;
        }

        if($largeur != "0")
        {
            $sql .= " AND pneu_largeur=:largeur";
            $param[":largeur"] = $largeur;
        }
        if($serie != "0")
        {
            $sql .= " AND pneu_serie=:serie";
            $param[":serie"] = $serie;
        }
        if($jante != "0")
        {
            $sql .= " AND pneu_jante=:jante";
            $param[":jante"] = $jante;
        }
        if($charge != "0")
        {
            $sql .= " AND pneu_charge=:charge";
            $param[":charge"] = $charge;
        }
        if($vitesse != "0")
        {
            $sql .= " AND pneu_vitesse=:vitesse";
            $param[":vitesse"] = $vitesse;
        }
        if($consommation != "0"){
            $sql .= " AND pneu_consommation=:consommation";
            $param[":consommation"] = $consommation;
        }
        if($decibel != "0")
        {
            $sql .= " AND pneu_decibel=:decibel";
            $param[":decibel"] = $decibel;
        }
        $numeroPage = ($numeroPage - 1)*$itemParPage;
        switch($order) {
            case 0:
                $sql .= " ORDER BY pneu_marque ASC LIMIT ".$numeroPage.", ".$itemParPage;
                break;

            case 1:
                $sql .= " ORDER BY pneu_prix ASC LIMIT ".$numeroPage.", ".$itemParPage;
                break;
            case 2:
                $sql .= " ORDER BY pneu_prix DESC LIMIT ".$numeroPage.", ".$itemParPage;
                break;
            default:
                $sql .= " LIMIT ".$numeroPage.", ".$itemParPage;
                break;
        }
        $res = SQLSelect($sql, $param);

        $tab= array();
        //Si il n'y a pas de résultat on passe le foreach
        if($res != null) {
            foreach ($res as $row) {
                $pneu = new Pneu($row);
                $entry = array("pneu" => $row, "prix" => $pneu->getPrix());
                array_push($tab, $entry);

            }
        }

        return $tab;
    }
}