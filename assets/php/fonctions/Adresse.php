<?php
include_once "maLibSQL.pdo.php";
class Adress{


    /**
	*  
	* @brief Insère l'adresse passée en paramètre dans la BDD
	* @param string adresse_ligne1 informations principales sur l'adresse
	* @param string adresse_ligne2 informations complémentaires pour l'adresse
	* @param int adresse_codeP code postal
	* @param string adresse_ville Ville
	* @param int user_id l'ID de l'utilisateur à qui on va créer une adresse
	* @return boolean|int false si l'ajout n'a pas fonctionné, ID le dernier ID ajouté dans la BDD
	*
	**/
    public static function mkAdresse($adresse_ligne1, $adresse_ligne2, $adresse_codeP, $adresse_ville, $user_id){
            $sql ="INSERT INTO adresse(adresse_ligne1,adresse_ligne2, adresse_codeP, adresse_ville, user_id) VALUES (:adr1, :adr2, :codeP, :ville, :id)";
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

     /**
	*  
	* @brief Récupère l'adresse d'un utilisateur dont on fournit l'ID
	* @param int id l'ID de l'utilisateur duquel on veut récupérer l'adresse
	* @return array res l'adresse et les informations sur l'adresse de l'utilisateur dont on a l'ID
	*
	**/
    public static function getAdresse($id){
        $sql="SELECT * FROM adresse WHERE user_id =:id ";
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
    /**
	*  
	* @brief Récupère l'adresse dont on fournit l'ID
	* @param int id l'ID de l'adresse que l'on veut récupérer
	* @return array res l'adresse et les informations sur l'adresse dont on a fournit l'ID
	*
	**/
    public static function getAdresseByIDAdresse($id){
        $sql="SELECT * FROM adresse WHERE adresse_id=:id ";
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

   /**
	*  
	* @brief Modifie l'adresse
	* @param string adresse_ligne1 informations principales sur l'adresse
	* @param string adresse_ligne2 informations complémentaires pour l'adresse
	* @param int adresse_codeP code postal
	* @param string adresse_ville Ville
	* @param int user_id l'ID de l'utilisateur à qui on va modifier une adresse
	* @return 
	*
	**/
    public static function setAdresse($adresse_ligne1, $adresse_ligne2, $adresse_codeP, $adresse_ville, $user_id){

        $sql = "UPDATE adresse SET adresse_ligne1=:adr1, adresse_ligne2=:adr2, adresse_codeP=:codeP, adresse_ville=:ville WHERE user_id=:id";
        $param = [
            ":adr1" => $adresse_ligne1,
            ":adr2" => $adresse_ligne2,
            ":codeP" => $adresse_codeP,
            ":ville" => $adresse_ville,
            ":id" => $user_id
        ];

        SQLUpdate($sql, $param);
    }

     /**
	*  
	* @brief Modifie l'adresse
	* @param string adresse_ligne1 informations principales sur l'adresse
	* @param string adresse_ligne2 informations complémentaires pour l'adresse
	* @param int adresse_codeP code postal
	* @param string adresse_ville Ville
	* @param int user_id l'ID de l'utilisateur à qui on va modifier une adresse
	* @return return de la fonction SQLUpdate
	*
	**/
    public static function setAdresseByIdAdresse($adresse_ligne1, $adresse_ligne2, $adresse_codeP, $adresse_ville, $adresse_id){

        $sql = "UPDATE adresse SET adresse_ligne1=:adr1, adresse_ligne2=:adr2, adresse_codeP=:codeP, adresse_ville=:ville WHERE user_id=:id";
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