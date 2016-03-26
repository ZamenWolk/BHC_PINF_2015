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
            $res = SQLInsert($sql,$param);
            if($res !=  false)
                return $res;
            else return false;
    }

    /** getAdresse
     * renvoie l'adresse d'un utilisateur
     * @param $id id de l'utilisateur
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
        return $res;
    }
    /** getAdresseByIdAdresse
     * renvoie l'adresse d'un utilisateur
     * @param $id , id de l'adresse
     * @return array
     */
    public static function getAdresseByIDAdresse($id){
        $sql="SELECT * FROM jspneus.adresse WHERE adresse_id=:id ";
        $param[":id"] = $id;
        $res = SQLSelect($sql,$param);
        $tab = array();
        if($res != null) {
            foreach ($res as $row) {
                array_push($tab, $row);
            }
        }
        return $res;
    }

    /** setAdresse
     * @param $adresse_ligne1
     * @param $adresse_ligne2
     * @param $adresse_codeP
     * @param $adresse_ville
     * @param $user_id
     */
    public static function setAdresse($adresse_ligne1, $adresse_ligne2, $adresse_codeP, $adresse_ville, $user_id){

        $sql = "UPDATE jspneus.adresse SET adresse_ligne1=:adr1, adresse_ligne2=:adr2, adresse_codeP=:codeP, adresse_ville=:ville WHERE user_id=:id";
        $param = [
            ":adr1" => $adresse_ligne1,
            ":adr2" => $adresse_ligne2,
            ":codeP" => $adresse_codeP,
            ":ville" => $adresse_ville,
            ":id" => $user_id
        ];

        SQLUpdate($sql, $param);
    }

    /** setAdresseByIdAdress
     * @param $adresse_ligne1
     * @param $adresse_ligne2
     * @param $adresse_codeP
     * @param $adresse_ville
     * @param $adresse_id
     */
    public static function setAdresseByIdAdresse($adresse_ligne1, $adresse_ligne2, $adresse_codeP, $adresse_ville, $adresse_id){

        $sql = "UPDATE jspneus.adresse SET adresse_ligne1=:adr1, adresse_ligne2=:adr2, adresse_codeP=:codeP, adresse_ville=:ville WHERE user_id=:id";
        $param = [
            ":adr1" => $adresse_ligne1,
            ":adr2" => $adresse_ligne2,
            ":codeP" => $adresse_codeP,
            ":ville" => $adresse_ville,
            ":id" => $adresse_id
        ];

        SQLUpdate($sql, $param);
    }
}

?>