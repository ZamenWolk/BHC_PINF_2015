<?php


include_once "../../../secret/credentials.php";
include_once "maLibSQL.pdo.php";



class Recherche{
    /** rechercherMarque
     * @return bool|resource
     * Recherche toutes les marques diponibles
     */
    public static function rechercherMarque()
    {
        $sql="SELECT DISTINCT pneu_marque FROM jspneus.pneu ORDER BY pneu_marque ASC";
        return SQLSelect($sql, array());
    }

    /** rechercherCategorie
     * @return bool|resource
     * Recherche toutes les categorie diponibles
     */
    public static function rechercherCategorie()
    {
        $sql="SELECT DISTINCT pneu_categorie FROM jspneus.pneu ORDER BY pneu_categorie ASC";
        return SQLSelect($sql, array());
    }
    /** rechercherLargeur
     * @return bool|resource
     * Recherche toutes les largeurs diponibles
     */
    public static function rechercherLargeur()
        {
            $sql="SELECT DISTINCT pneu_largeur FROM jspneus.pneu ORDER BY pneu_largeur ASC";
            return SQLSelect($sql, array());
        }

    /** rechercherJante
     * @return bool|resource
     * Recherche toutes les jantes diponibles
     */
    public static function rechercherJante()
        {
            $sql="SELECT DISTINCT pneu_jante FROM jspneus.pneu ORDER BY  pneu_jante ASC";
            return SQLSelect($sql, array());
        }

        /** rechercherCharge
         * @return bool|resource
         * Recherche toutes les charges diponibles
         */
    public static function rechercherCharge()
        {
            $sql="SELECT DISTINCT pneu_charge FROM jspneus.pneu ORDER BY pneu_charge ASC";
            return SQLSelect($sql, array());
        }

        /** rechercherVitesse
         * @return bool|resource
         * Recherche toutes les vitesses diponibles
         */
    public static function rechercherVitesse()
        {
            $sql="SELECT DISTINCT pneu_vitesse FROM jspneus.pneu ORDER BY pneu_vitesse ASC";
            return SQLSelect($sql, array());
        }
    /** rechercherSerie
     * @return bool|resource
     * Recherche toutes les series diponibles
     */
    public static function rechercherSerie()
    {
        $sql="SELECT DISTINCT pneu_serie FROM jspneus.pneu ORDER BY pneu_serie ASC";
        return SQLSelect($sql, array());
    }
}