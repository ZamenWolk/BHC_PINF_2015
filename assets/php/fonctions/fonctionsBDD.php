<?php



include_once "../../../secret/credentials.php";
include_once "maLibSQL.pdo.php";

/** mkUser
 * @param $mail
 * @param $mdp
 * @param $nom
 * @param $prenom
 * Créer un utilisateur et l'enregistre dans la base
 */
function mkUser($mail, $mdp, $nom, $prenom)//Permet la création d'un utilisateur fonctionnelle
{
    $mdp=password_hash($mdp, PASSWORD_BCRYPT);
    //echo $mdp;
    $sql="INSERT INTO jspneus.user(user_mail, user_password, user_nom, user_prenom) VALUES (:mail,:mdp,:nom,:prenom)";

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
    $sql="SELECT DISTINCT pneu_marque FROM jspneus.pneu";
    return SQLSelect($sql, array());
}
