<?php

//session_start();
include_once "maLibSQL.pdo.php";
include_once "../../../secret/credentials.php";
class User
{
	/**
	*  
	* @brief Créer un utilisateur
	* @param user user Utilisateur que l'on va créer via les variables que nous récupérons
	*
	**/
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

	/**
	*  
	* @brief Créer à l'aide d'informations à passer en paramètre
	* @param string nom Nom de l'utilisateur
	* @param string prenom Prénom de l'utilisateur
	* @param string mail Mail de l'utilisateur 
	* @param string password Mot de passe de l'utilisateur
	* @param boolean newsletter Adhésion ou non de l'utilisateur à la newsletter
	* @param string telephone Numéro de téléphone de l'utilisateur 
	* @return user user L'utilisateur qu'on a crée
	**/
    public static function UserFromData($nom, $prenom, $mail, $password, $newsletter, $telephone)
    {
        $param = array("user_id" => 0, "user_nom" => $nom, "user_prenom" => $prenom, "user_mail" => $mail, "user_password" => password_hash($password, PASSWORD_BCRYPT), "user_newsletter" => $newsletter, "user_telephone" => $telephone);
        $user = new User($param);

        return $user;
    }

	/**
	*  
	* @brief Ajoute un utilisateur à la BDD
	* @return boolean|int false si on ne peut pas inscrire un utilisateur en BDD, ID de l'utilisateur si on peut l'inscrire
	*
	**/
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

	/**
	*  
	* @brief Modifie les informations d'un utilisateur dont on fournit l'ID
	* @param int id l'ID de l'utilisateur dont on veut modifier les informations
	* @return boolean|boolean false si l'ID de la personne est introuvable, true si l'update a fonctionné
	*
	**/
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
	
	/**
	*  
	* @brief Permet à un utilisateur de se connecter
	* @param string mdpEntre Mot de passe rentré par l'utilisateur pour se connecter
	* @return boolean|int|boolean false si l'utilisateur est déjà connecté, son ID si la connexion a fonctionné, false si la vérification du mot de passe n'a pas été concluante
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
            $_SESSION["connexion"]["connecte"] = true;
            $_SESSION["connexion"]["id"] = $this->ID;
            $_SESSION["connexion"]["admin"] = false;
            return $this->ID;
        }

        return false;
    }

	/**
	* @brief Vérifie le mot de passe de l'utilisateur 
	* @param string mdp Mot de passe que l'on veut vérifier
	* @return boolean|boolean false si le mot de passe n'est pas le bon, true sinon
	*
	**/
    public function verifierMDP($mdp)
    {
        return password_verify($mdp, $this->password);
    }

	/**
	* @brief Modifie le mot de passe d'un utilisateur 
	* @param string oldPass Ancien mot de passe de l'utilisateur à mdifier
	* @param string newPass Nouveau mot de passe de l'utilisateur
	* @param int id ID de l'utilisateur dont on veut changer le mot de passe
	* @return boolean|boolean|boolean false si la recherche n'a pas été concluante, false si le mot de passe qu'on veut vérifier n'est pas le bon, true si la modification a bien eu lieu
	*
	**/
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

	/**
	* @brief Récupère l'ID de l'utilisateur si il est connecté 
	* @return boolean|boolean|int false si l'utilisateur n'est pas connecté, false si il s'agit d'un administrateur ou si il n'est pas connecté, ID l'ID de la personne connectée
	*
	**/
    public static function getIDConnecte()
    {
        if (!isset($_SESSION["connexion"]))
            return false;

        $connexion = $_SESSION["connexion"];

        if ($connexion["connecte"] == false || $connexion["admin"] == true)
            return false;

        return $connexion["id"];
    }

	/**
	* @brief Déconnecte un utilisateur
	*
	**/
    public static function deconnecter()
    {
        unset($_SESSION["connexion"]);
    }

	/**
	* @brief Récupère un utilisateur par un ID passé en paramètre
	* @param int id ID l'ID de l'utilisateur qu'on souhaite récupérer
	* @return boolean|User false si la requète SQL n'a pas pu trouvé l'utilisateur, L'utilisateur si on a réussi à le trouver
	*
	**/
    public static function getUserFromID($id)
    {
        $sql = "SELECT * FROM user WHERE user_id=?";
        $res = SQLSelect($sql, [$id]);

        if ($res === false)
            return $res;
        else
            return new User($res[0]);
    }
	
	/**
	* @brief Récupère un utilisateur par une adresse email passée en paramètre
	* @param string mail adresse email de l'utilisateur qu'on souhaite récupérer
	* @return boolean|User false si la requète SQL n'a pas pu trouvé l'utilisateur, L'utilisateur si on a réussi à le trouver
	*
	**/
    public static function getUserFromMail($mail)
    {
        $sql = "SELECT * FROM user WHERE user_mail=?";
        $res = SQLSelect($sql, [$mail]);

        if ($res === false)
            return $res;
        else
            return new User($res[0]);
    }

	/**
	* @brief Récupère un utilisateur avec son mot de passe si on le spécifie
	* @param boolean withPass Valeur booléenne permettant de savoir 
	* @return User user les informations de l'utilisateur dans la variable tableau user
	*
	**/
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