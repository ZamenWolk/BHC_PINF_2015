<?php


include_once("Pneu.php");
include_once "maLibSQL.pdo.php";



class Recherche{
    /** rechercherMarque
     * @return array
     * Recherche toutes les marques diponibles
     */
    public static function rechercherMarque()
    {
        $sql="SELECT DISTINCT pneu_marque FROM jspneus.pneu ORDER BY pneu_marque ASC";
        $res = SQLSelect($sql, array());
        $tab = array();

        foreach($res as $row)
        {
            array_push($tab, $row["pneu_marque"]);
        }
        return $tab;
    }

    /** rechercherCategorie
     * @return array
     * Recherche toutes les categorie diponibles
     */
    public static function rechercherCategorie()
    {
        $sql="SELECT DISTINCT pneu_categorie FROM jspneus.pneu ORDER BY pneu_categorie ASC";
        $res = SQLSelect($sql, array());
        $tab = array();

        foreach($res as $row)
        {
            array_push($tab, $row["pneu_categorie"]);
        }
        return $tab;
    }
    /** rechercherLargeur
     * @return array
     * Recherche toutes les largeurs diponibles
     */
    public static function rechercherLargeur()
        {
            $sql="SELECT DISTINCT pneu_largeur FROM jspneus.pneu ORDER BY pneu_largeur ASC";
            $res = SQLSelect($sql, array());
            $tab = array();

            foreach($res as $row)
            {
                array_push($tab, $row["pneu_largeur"]);
            }
            return $tab;
        }

    /** rechercherJante
     * @return array
     * Recherche toutes les jantes diponibles
     */
    public static function rechercherJante()
        {
            $sql="SELECT DISTINCT pneu_jante FROM jspneus.pneu ORDER BY  pneu_jante ASC";
            $res = SQLSelect($sql, array());
            $tab = array();

            foreach($res as $row)
            {
                array_push($tab, $row["pneu_jante"]);
            }
            return $tab;
        }

        /** rechercherCharge
         * @return array
         * Recherche toutes les charges diponibles
         */
    public static function rechercherCharge()
        {
            $sql="SELECT DISTINCT pneu_charge FROM jspneus.pneu ORDER BY pneu_charge ASC";
            $res = SQLSelect($sql, array());
            $tab = array();

            foreach($res as $row)
            {
                array_push($tab, $row["pneu_charge"]);
            }
            return $tab;
        }

        /** rechercherVitesse
         * @return array
         * Recherche toutes les vitesses diponibles
         */
    public static function rechercherVitesse()
        {
            $sql="SELECT DISTINCT pneu_vitesse FROM jspneus.pneu ORDER BY pneu_vitesse ASC";
            $res = SQLSelect($sql, array());
            $tab = array();

            foreach($res as $row)
            {
                array_push($tab, $row["pneu_vitesse"]);
            }
            return $tab;
        }

    /** rechercherVitesse
     * @return array
     * Recherche toutes les cat de décibel diponibles
     */

    public static function rechercherDecibel()
    {
        $sql="SELECT DISTINCT pneu_decibel FROM jspneus.pneu ORDER BY pneu_vitesse ASC";
        $res = SQLSelect($sql, array());
        $tab = array();

        foreach($res as $row)
        {
            array_push($tab, $row["pneu_decibel"]);
        }
        return $tab;
    }
    /** rechercherConsommation
     * @return array
     * Recherche toutes les cat de consommation diponibles
     */
    public static function rechercherConsommation()
    {
        $sql="SELECT DISTINCT pneu_consommation FROM jspneus.pneu ORDER BY pneu_consommation ASC";
        $res = SQLSelect($sql, array());
        $tab = array();

        foreach($res as $row)
        {
            array_push($tab, $row["pneu_consommation"]);
        }
        return $tab;
    }
    /** rechercherSerie
     * @return array
     * Recherche toutes les series diponibles
     */
    public static function rechercherSerie()
    {
        $sql="SELECT DISTINCT pneu_serie FROM jspneus.pneu ORDER BY pneu_serie ASC";
        $res = SQLSelect($sql, array());
        $tab = array();

        foreach($res as $row)
        {
            array_push($tab, $row["pneu_serie"]);
        }
        return $tab;
    }

    public static function rechercherPneu($ref){
        $sql ="SELECT * FROM jspneus.pneu WHERE pneu_ref=:ref AND pneu_valable=1";
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


    public static function rechercher($cat, $marque, $largeur, $serie, $jante, $charge,$vitesse,$consommation,$decibel,$numeroPage, $itemParPage,$order = 0)
    {
        $sql = "SELECT * FROM jspneus.pneu WHERE pneu_valable=1";
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