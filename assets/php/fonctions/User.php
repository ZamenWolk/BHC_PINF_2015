<?php

//session_start();
include_once "maLibSQL.pdo.php";
include_once "../../../secret/credentials.php";
class User
{
    public function User($user)
    {
        $this->ID = $user["user_id"];
        $this->nom = $user["user_nom"];
        $this->prenom = $user["user_prenom"];
        $this->mail = $user["user_mail"];
        $this->password = $user["user_password"];
        $this->newsletter = $user["user_newsletter"];
        $this->telephone = $user["user_telephone"];
    }

    public static function UserFromData($nom, $prenom, $mail, $password, $newsletter, $telephone)
    {
        $param = array("user_id" => 0, "user_nom" => $nom, "user_prenom" => $prenom, "user_mail" => $mail, "user_password" => password_hash($password, PASSWORD_BCRYPT), "user_newsletter" => $newsletter, "user_telephone" => $telephone);
        $user = new User($param);

        return $user;
    }

    public function inscrireEnBDD()
    {
        if (SQLSelect("SELECT * FROM user WHERE user_mail=?", [$this->mail]))
            return false;
        else
        {
            SQLInsert("INSERT INTO user(user_nom, user_prenom, user_mail, user_password, user_newsletter, user_telephone) VALUES (?, ?, ?, ?, ?, ?)", [$this->nom, $this->prenom, $this->mail, $this->password, $this->newsletter, $this->telephone]);
            $this->User(SQLSelect("SELECT * FROM user WHERE user_mail=?", [$this->mail])[0]);
            return $this->ID;
        }
    }

    public function modifierInformations($id)
    {
        if (!SQLSelect("SELECT * FROM user WHERE user_id=?", [$id]))
            return false;
        else
        {
            SQLUpdate("UPDATE user SET user_nom=?, user_prenom=?, user_mail=?, user_newsletter=?, user_telephone=? WHERE user_id=?", [$this->nom, $this->prenom, $this->mail, $this->newsletter, $this->telephone, $id]);
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
            /*$connexion = &$_SESSION["connexion"];
            $connexion["connecte"] = true;
            $connexion["id"] = $this->ID;
            $connexion["admin"] = false;*/
            $_SESSION["connexion"]["connecte"] = true;
            $_SESSION["connexion"]["id"] = $this->ID;
            $_SESSION["connexion"]["admin"] = false;
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
        $res = SQLSelect("SELECT user_password FROM user WHERE user_id=?", [$id]);

        if ($res === false)
            return false;

        $currPass = $res[0]["user_password"];

        if (!password_verify($oldPass, $currPass))
            return false;

        SQLUpdate("UPDATE user SET user_password=? WHERE user_id=?", [password_hash($newPass, PASSWORD_BCRYPT), $id]);
        return true;
    }

    public static function getIDConnecte()
    {
        if (!isset($_SESSION["connexion"]))
            return false;

        $connexion = $_SESSION["connexion"];

        if ($connexion["connecte"] == false || $connexion["admin"] == true)
            return false;

        return $connexion["id"];
    }

    public static function deconnecter()
    {
        unset($_SESSION["connexion"]);
    }

    public static function getUserFromID($id)
    {
        $sql = "SELECT * FROM user WHERE user_id=?";
        $res = SQLSelect($sql, [$id]);

        if ($res === false)
            return $res;
        else
            return new User($res[0]);
    }

    public static function getUserFromMail($mail)
    {
        $sql = "SELECT * FROM user WHERE user_mail=?";
        $res = SQLSelect($sql, [$mail]);

        if ($res === false)
            return $res;
        else
            return new User($res[0]);
    }

    public function getUser($withPass = false)
    {
        $user = array();
        $user["ID"] = $this->ID;
        $user["nom"] = $this->nom;
        $user["prenom"] = $this->prenom;
        $user["mail"] = $this->mail;
        $user["newsletter"] = $this->newsletter;
        $user["telephone"] = $this->telephone;

        if ($withPass)
            $user["password"] = $this->password;

        return $user;
    }

    private $ID;
    private $nom;
    private $prenom;
    private $mail;
    private $password;
    private $newsletter;
    private $telephone;
}