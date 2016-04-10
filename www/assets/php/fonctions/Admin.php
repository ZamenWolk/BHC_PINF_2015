<?php

include_once "../../../secret/credentials.php";
include_once "../fonctions/maLibSQL.pdo.php";

class Admin
{
	/**
	*  
	* @brief Créer un administrateur 
	* @param admin Informations pour créer l'utilisateur 
	*
	**/
    public function Admin($admin)
    {
        $this->ID = $admin["admin_id"];
        $this->nom = $admin["admin_name"];
        $this->password = $admin["admin_pass"];
        $this->autorisations = $admin["admin_autorisations"];
    }

	/**
	*  
	* @brief Créer un administrateur à partir d'informations passées en paramètres
	* @param nom Nom de l'administrateur
	* @param password Mot de passe de l'administrateur
	* @param autorisations Donne les droits d'administration
	* @return Admin L'administrateur crée
	*
	**/
    public static function AdminFromData($nom, $password, $autorisations)
    {
        $param = array("admin_id" => -1, "admin_name" => $nom, "admin_pass" => password_hash($password, PASSWORD_BCRYPT), "admin_autorisations" => $autorisations);
        $user = new Admin($param);
        return $user;
    }

	/**
	*  
	* @brief Inscrit un administrateur en BDD
	* @return boolean|int  false si l'administrateur est inscrit en BDD, l'ID en BDD de l'administrateur qu'on vient d'inscrire
	*
	**/
    public function inscrireEnBDD()
    {
        if (SQLSelect("SELECT * FROM admin WHERE admin_name=?", [$this->nom]))
            return false;
        else
        {
            SQLInsert("INSERT INTO admin(admin_name, admin_pass, admin_autorisations) VALUES (?, ?, ?)", [$this->nom, $this->password, $this->autorisations]);
            $this->Admin(SQLSelect("SELECT * FROM admin WHERE admin_name=?", [$this->nom])[0]);
            return $this->ID;
        }
    }

	
	/**
	*  
	* @brief Modifie les informations d'un utilisateur en BDD
	* @return boolean|boolean  false si l'administrateur n'existe pas, true si on a reussit a mettre à jour les informations
	*
	**/
    public function modifierInformations($id)
    {
        if (!SQLSelect("SELECT * FROM admin WHERE admin_id=?", [$id]))
            return false;
        else
        {
            SQLUpdate("UPDATE admin SET admin_name=?, admin_autorisations=? WHERE admin_id=?", [$this->nom, $this->autorisations, $id]);
            return true;
        }
    }

	/**
	*  
	* @brief Permet a un administrateur de se connecter
	* @param string Mot de passe entré
	* @return boolean|int|booleab  false si l'administrateur est déjà connecté , ID si la connexion a bien marché, false si la vérification du mot de passe s'est avérée fausse (le mot de passe n'est pas le bon)
	*
	**/
    public function connecter($mdpEntre)
    {
        if (isset($_SESSION["connexion"]))
            if (array_key_exists("connecte", $_SESSION["connexion"]))
                return false;

        if (password_verify($mdpEntre, $this->password))
        {
            $_SESSION["connexion"] = array();
            $connexion = &$_SESSION["connexion"];
            $connexion["connecte"] = true;
            $connexion["id"] = $this->ID;
            $connexion["admin"] = true;

            return $this->ID;
        }

        return false;
    }

	/**
	*  
	* @brief Vérifie le mot de passe
	* @param string mot de passe à vérifier
	* @return boolean false si le hachage ne correpond pas, true sinon
	*
	**/
    public function verifierMDP($mdp)
    {
        return password_verify($mdp, $this->password);
    }

	/**
	*  
	* @brief Change le mot de passe d'un administrateur
	* @param string ancien mot de passe
	* @param string le nouveau mot de passe
	* @param id l'ID de l'admnistrateur a qui on va changer le mot de passe
	* @return boolean|boolean|boolean false si on ne trouve pas l'ID de l'utilisateur, false si la vérification du hachage n'a pas marché, true si l'utilisateur existe et que la modification mot de passe et son cryptage a fonctionné
	*
	**/
    public static function changePassword($oldPass, $newPass, $id)
    {
        $res = SQLSelect("SELECT admin_pass FROM admin WHERE admin_id=?", [$id]);

        if ($res === false)
            return false;

        $currPass = $res[0]["admin_password"];

        if (!password_verify($oldPass, $currPass))
            return false;

        SQLUpdate("UPDATE admin SET admin_pass=? WHERE admin_id=?", [password_hash($newPass, PASSWORD_BCRYPT), $id]);
        return true;
    }
	
	/**
	*  
	* @brief Récupère l'ID de l'utilisateur connecté
	* @return boolean|boolean|int false si la variable de session gérant la connexion n'est pas présente, false si les variables de session d'état de connexion et d'admin ne sont pas présentes, ID l'ID de l'admin connecté
	*
	**/
    public static function getIDConnecte()
    {
        if (!isset($_SESSION["connexion"]))
            return false;

        $connexion = $_SESSION["connexion"];

        if ($connexion["connecte"] == false || $connexion["admin"] == false)
            return false;

        return $connexion["id"];
    }

	
	/**
	*  
	* @brief Déconnecte l'utilisateur
	*
	**/
    public static function deconnecter()
    {
        unset($_SESSION["connexion"]);
    }

	/**
	*  
	* @brief Récupère l'administrateur en fonction de son ID
	* @param int ID l'ID que l'on veut chercher
	* @return boolean|Admin false si on n'a pas pu récupérer l'admin avec l'ID donné, Admin retourne l'administrateur avec l'ID que l'on cherchait
	*
	**/
    public static function getAdminFromID($id)
    {
        $sql = "SELECT * FROM admin WHERE admin_id=?";
        $res = SQLSelect($sql, [$id]);

        if ($res === false)
            return $res;
        else
            return new Admin($res[0]);
    }

	/**
	*  
	* @brief Récupère l'administrateur en fonction de son nom
	* @param string name Nom de l'admin que l'on cherche
	* @return boolean|Admin false si on n'a pas pu récupérer l'admin avec le nom donné, Admin retourne l'administrateur avec le nom que l'on cherchait
	*
	**/
    public static function getAdminFromName($name)
    {
        $sql = "SELECT * FROM admin WHERE admin_name=?";
        $res = SQLSelect($sql, [$name]);

        if ($res === false)
            return $res;
        else
            return new Admin($res[0]);
    }

	/**
	*  
	* @brief Récupère l'administrateur avec son mot de passe si on le spécifie via le paramètre
	* @param boolean withPass par défaut sur false, à mettre en true si on veut récupérer le mot de passe de l'administrateur en même temps que les autres informations
	* @return admin user l'administrateur avec ses informations
	*
	**/
    public function getAdmin($withPass = false)
    {
        $user = array();
        $user["ID"] = $this->ID;
        $user["nom"] = $this->nom;
        $user["autorisations"] = $this->autorisations;

        if ($withPass)
            $user["password"] = $this->password;

        return $user;
    }

    private $ID;
    private $nom;
    private $password;
    private $autorisations;
}