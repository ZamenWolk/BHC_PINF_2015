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
        if (isset($_SESSION["connecte"]) && $_SESSION["connecte"] == true)
            return false;

        if (password_verify($mdpEntre, $this->password))
        {
            $_SESSION["connecte"] = true;
            $_SESSION["connecte_id"] = $this->ID;
            $_SESSION["connecte_admib"] = false;

            return true;
        }

        return false;
    }

    public static function deconnecter()
    {
        unset($_SESSION["connecter"]);
        unset($_SESSION["connecter_id"]);
        unset($_SESSION["connecter_admin"]);
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

    public function getID()
    {
        return $this->ID;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getNewsletter()
    {
        return $this->newsletter;
    }

    private $ID;
    private $nom;
    private $prenom;
    private $mail;
    private $password;
    private $newsletter;
}