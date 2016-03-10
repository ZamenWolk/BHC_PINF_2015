<?php

session_start();

class User
{
    public function User($user)
    {
        $this->ID = $user["user_ID"];
        $this->nom = $user["user_nom"];
        $this->prenom = $user["user_prenom"];
        $this->mail = $user["user_mail"];
        $this->password = $user["user_password"];
        $this->newsletter = $user["user_newsletter"];
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
            $connexion["admin"] = false;

            return true;
        }

        return false;
    }

    public function verifierMDP($mdp)
    {
        return password_verify($mdp, $this->password);
    }

    public static function getIDConnecte()
    {
        if (!isset($_SESSION["connexion"]))
            return false;

        $connexion = $_SESSION["connexion"];

        if ($connexion["connecte"] == false || $connexion["admin"] = true)
            return false;

        return $connexion["id"];
    }

    public static function deconnecter()
    {
        unset($_SESSION["connexion"]);
    }

    public static function getUserFromID($id)
    {
        $sql = "SELECT * FROM jspneus.user WHERE user_id=?";
        $res = SQLSelect($sql, [$id]);

        if ($res === null)
            return $res;
        else
            return new User($res[0]);
    }

    public static function getUserFromMail($mail)
    {
        $sql = "SELECT * FROM jspneus.user WHERE user_mail=?";
        $res = SQLSelect($sql, [$mail]);

        if ($res === null)
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
}