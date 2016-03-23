<?php
include_once "maLibSQL.pdo.php";
class Adress{


    /** mkAdresse
     *  insert en bdd l'adresse
     * @param $adresse_ligne1
     * @param $adresse_ligne2
     * @param $adresse_codeP
     * @param $adresse_ville
     * @param $user_id
     * @return resource|bool
     */
    public static function mkAdresse($adresse_ligne1, $adresse_ligne2, $adresse_codeP, $adresse_ville, $user_id){
            $sql ="INSERT INTO jspneus.adresse(adresse_ligne1,adresse_ligne2, adresse_codeP, adresse_ville, user_id) VALUES (:adr1, :adr2, :codeP, :ville, :id)";
            $param = [
                ":adr1" => $adresse_ligne1,
                ":adr2" => $adresse_ligne2,
                ":codeP" => $adresse_codeP,
                ":ville" => $adresse_ville,
                ":id" => $user_id
            ];
            return SQLInsert($sql,$param);
    }

    /** getAdresse
     * renvoie l'adresse d'un utilisateur
     * @param $id
     * @return array
     */
    public static function getAdresse($id){
        $sql="SELECT * FROM jspneus.adresse WHERE user_id =:id ";
        $param[":id"] = $id;
        $res = SQLSelect($sql,$param);
        $tab = array();
        if($res != null) {
            foreach ($res as $row) {
                array_push($tab, $row);

            }
        }
        return $tab;
    }

    /** setAdresse
     * @param $adresse_ligne1
     * @param $adresse_ligne2
     * @param $adresse_codeP
     * @param $adresse_ville
     * @param $user_id
     */
    public static function setAdresse($adresse_ligne1, $adresse_ligne2, $adresse_codeP, $adresse_ville, $user_id){

        $sql = "UPDATE jspneus.user SET adresse_ligne1=:adr1, adresse_ligne2=:adr2, adresse_codeP=:codeP, adresse_vlle=:ville WHERE user_id=:id";
        $param = [
            ":adr1" => $adresse_ligne1,
            ":adr2" => $adresse_ligne2,
            ":codeP" => $adresse_codeP,
            ":ville" => $adresse_ville,
            ":id" => $user_id
        ];

        SQLUpdate($sql, $param);
    }
}

?>