<?php
include_once "maLibSQL.pdo.php";

/** securite_bdd
 * @param $string
 * @return int|string
 * protége les entrées utilisateur contre les injections dans la bdd
 */
function securite_bdd($string)
{
    // On regarde si le type de string est un nombre entier (int)
    if(ctype_digit($string))
    {
        $string = intval($string);
    }
    // Pour tous les autres types
    else
    {
        $string = addslashes($string);
        $string = addcslashes($string, '%_');
    }


    return $string;
}

/** mkUser
 * @param $mail
 * @param $mdp
 * @param $nom
 * @param $prenom
 * Créer un utilisateur et l'enregistre dans la base
 */
function mkUser($mail, $mdp, $nom, $prenom)//Permet la création d'un utilisateur fonctionnelle
{
    $mail=securite_bdd($mail);
    $nom=securite_bdd($nom);
    $prenom=securite_bdd($prenom);
    $mdp=securite_bdd($mdp);
    $mdp=password_hash($mdp, PASSWORD_BCRYPT);
    //echo $mdp;
    $sql="INSERT INTO users(user_mail, user_password, user_nom, user_prenom) VALUES (:mail,:mdp,:nom,:prenom)";

    $param = [
        ":mail" => $mail,
        ":mdp" => $mdp,
        ":nom" => $nom,
        ":prenom" => $prenom
    ];

    SQLInsert($sql, $param);
}

/** rechercherMarque
 * @param $marque
 * @return bool|resource
 * Recherche toutes les marques diponibles
 */
function rechercherMarque()
{
    $sql="SELECT DISTINCT marque FROM pneus";
    return SQLSelect($sql, array());
}









