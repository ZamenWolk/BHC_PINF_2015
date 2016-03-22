<?php



include_once "../../../secret/credentials.php";
include_once "../fonctions/maLibSQL.pdo.php";

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



/** verifDescription
 * @param $ref
 * @param $desc
 * @return int
 * On verifie si la description $desc et le prix $prix est la même que celle du pneu de reference $ref en bdd, si c'est ok on renvoie 1 sinon 0
 */

function verifDescription($ref, $desc, $prix)
{
    $sql="SELECT pneu_description FROM jspneus.pneu WHERE pneu_ref=:ref AND pneu_valable=1";
    $sql1="SELECT pneu_prix FROM jspneus.pneu WHERE pneu_ref=:ref AND pneu_valable=1";
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
