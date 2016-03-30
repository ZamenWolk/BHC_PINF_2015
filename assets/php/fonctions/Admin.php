<?php
include_once "maLibSQL.pdo.php";
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 19/03/2016
 * Time: 17:48
 */
class Admin
{
    public function Admin($admin)
    {
        $this->ID = $admin["admin_id"];
        $this->nom = $admin["admin_name"];
        $this->password = $admin["admin_pass"];
        $this->autorisations = $admin["admin_autorisations"];
    }

    public static function AdminFromData($nom, $password, $autorisations)
    {
        $param = array("admin_id" => 0, "admin_name" => $nom, "admin_pass" => password_hash($password, PASSWORD_BCRYPT), "admin_autorisations" => $autorisations);
        $user = new Admin($param);

        return $user;
    }

    public function inscrireEnBDD()
    {
        if (SQLSelect("SELECT * FROM jspneus.admin WHERE admin_name=?", [$this->nom]))
            return false;
        else
        {
            SQLInsert("INSERT INTO jspneus.admin(admin_name, admin_pass, admin_autorisations) VALUES (?, ?, ?)", [$this->nom, $this->password, $this->autorisations]);
            $this->Admin(SQLSelect("SELECT * FROM jspneus.user WHERE user_mail=?", [$this->nom])[0]);
            return $this->ID;
        }
    }

    public function modifierInformations($id)
    {
        if (!SQLSelect("SELECT * FROM jspneus.admin WHERE admin_id=?", [$id]))
            return false;
        else
        {
            SQLUpdate("UPDATE jspneus.admin SET admin_name=?, admin_autorisations=? WHERE admin_id=?", [$this->nom, $this->autorisations, $id]);
            return true;
        }
    }

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

    public function verifierMDP($mdp)
    {
        return password_verify($mdp, $this->password);
    }

    public static function changePassword($oldPass, $newPass, $id)
    {
        $res = SQLSelect("SELECT admin_pass FROM jspneus.admin WHERE admin_id=?", [$id]);

        if ($res === false)
            return false;

        $currPass = $res[0]["admin_password"];

        if (!password_verify($oldPass, $currPass))
            return false;

        SQLUpdate("UPDATE jspneus.admin SET admin_pass=? WHERE admin_id=?", [password_hash($newPass, PASSWORD_BCRYPT), $id]);
        return true;
    }

    public static function getIDConnecte()
    {
        if (!isset($_SESSION["connexion"]))
            return false;

        $connexion = $_SESSION["connexion"];

        if ($connexion["connecte"] == false || $connexion["admin"] == false)
            return false;

        return $connexion["id"];
    }

    public static function deconnecter()
    {
        unset($_SESSION["connexion"]);
    }

    public static function getAdminFromID($id)
    {
        $sql = "SELECT * FROM jspneus.admin WHERE admin_id=?";
        $res = SQLSelect($sql, [$id]);

        if ($res === false)
            return $res;
        else
            return new Admin($res[0]);
    }

    public static function getAdminFromName($name)
    {
        $sql = "SELECT * FROM jspneus.admin WHERE admin_name=?";
        $res = SQLSelect($sql, [$name]);

        if ($res === false)
            return $res;
        else
            return new Admin($res[0]);
    }

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