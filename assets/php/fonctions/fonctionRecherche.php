<?php



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

    public static function rechercher($cat, $marque, $largeur, $serie, $jante, $charge,$vitesse,$numeroPage, $itemParPage = 25)
    {
        $sql = "SELECT * FROM jspneus.pneu WHERE pneu_valable=1";
        $param = array();
        if($cat != "Toutes")
        {
            $sql .= " AND pneu_categorie=:categorie";
            $param[":categorie"] = $cat;
        }
        if($marque != "Toutes")
        {
            $sql .= " AND pneu_marque=:marque";
            $param[":marque"] = $marque;
        }

        if($largeur != "Toutes")
        {
            $sql .= " AND pneu_largeur=:largeur";
            $param[":largeur"] = $largeur;
        }
        if($serie != "Toutes")
        {
            $sql .= " AND pneu_serie=:serie";
            $param[":serie"] = $serie;
        }
        if($jante != "Toutes")
        {
            $sql .= " AND pneu_jante=:jante";
            $param[":jante"] = $jante;
        }
        if($charge != "Toutes")
        {
            $sql .= " AND pneu_charge=:charge";
            $param[":charge"] = $charge;
        }
        if($vitesse != "Toutes")
        {
            $sql .= " AND pneu_vitesse=:vitesse";
            $param[":vitesse"] = $vitesse;
        }
        $numeroPage = ($numeroPage - 1)*25;
        $sql.=" ORDER BY pneu_marque ASC LIMIT ".$numeroPage.", ".$itemParPage;
        //print_r($param);
        //return $sql;
        $res = SQLSelect($sql, $param);
        $tab= array();

        foreach($res as $row)
        {
            array_push($tab, $row);
        }
        return $tab;


    }
}