<?php

include_once "../../../secret/credentials.php";
include_once "../fonctions/maLibSQL.pdo.php";

/**
	*  
	* @brief Crée un utilisateur avec les informations passées en paramètre et l'ajoute à la BDD
	* @param string mail Mail de l'utilisateur
	* @param string mdp Mot de passe de l'utilisateur
	* @param string nom Nom de l'utilisateur
	* @param string prenom Prénim de l'utilisateur 
	* @return boolean, False si SQLInsert n'a pas pu insérer dans la BDD
	*
	**/
function mkUser($mail, $mdp, $nom, $prenom)
{
    $mdp=password_hash($mdp, PASSWORD_BCRYPT);
    $sql="INSERT INTO user(user_mail, user_password, user_nom, user_prenom) VALUES (:mail,:mdp,:nom,:prenom)";

    $param = [
        ":mail" => $mail,
        ":mdp" => $mdp,
        ":nom" => $nom,
        ":prenom" => $prenom
    ];

    SQLInsert($sql, $param);
}



/**
	*  
	* @brief Vérifie la description et le prix d'un pneu dont on passe les références, le prix et la description
	* @param string ref Référence du pneu
	* @param string desc Description du pneu
	* @param int prix Prix du pneu
	* @return int|int 1 si la description et le prix sont conformes à la BDD, 0 si la description et le prix sont différents
	*
	**/

function verifDescription($ref, $desc, $prix)
{
    $sql="SELECT pneu_description FROM pneu WHERE pneu_ref=:ref AND pneu_valable=1";
    $sql1="SELECT pneu_prix FROM pneu WHERE pneu_ref=:ref AND pneu_valable=1";
    $param=[
        ":ref" => $ref
    ];

    $descBDD = SQLGetChamp($sql,$param);
    $prixBDD = SQLGetChamp($sql1,$param);

    if($desc == $descBDD && $prix == $prixBDD)
        return 1;
    else
        return 0;
}
