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
    $sql="INSERT INTO users(user_mail, user_password, user_nom, user_prenom) VALUES ('$mail','$mdp','$nom','$prenom')";
    SQLInsert($sql);
}
/** connecte
 * @param $idUser
 * Met à 1 le champs user_connecte
 */
function connecte($idUser)// Place à 1 la variable "connecté" dans la base de données, utilise l'id de l'utilisateur
{
    $sql= "  UPDATE users
              SET user_connecte=1
             WHERE user_id='$idUser'";
    SQLUpdate($sql);
}

/** deconnecte
 * @param $idUser
 * Met à 0 le champs user_connecte
 */
function deconnecte($idUser)//Place à 0 la variable "connecté" dans la base de données, utilise l'id de l'utilisateur
{
    $sql= "  UPDATE users
              SET user_connecte=0
             WHERE user_id='$idUser'";
    SQLUpdate($sql);
}
/** modifNom
 * @param $mail
 * @param $prenom
 * Modifie le nom
 */
function modifNom($mail, $nom)//Permet de modifier le nom de famille par rapport au mail
{
    $sql= "  UPDATE users
              SET user_nom='$nom'
             WHERE user_mail='$mail'";
    SQLUpdate($sql);
}

/** modifPrenom
 * @param $mail
 * @param $prenom
 * Modifie le prenom
 */
function modifPrenom($mail, $prenom)//Permet de modifier le prénom
{
    $sql= "  UPDATE users
              SET user_prenom='$prenom'
             WHERE user_mail='$mail'";
    SQLUpdate($sql);
}

/** rechercherParMarque
 * @param $marque
 * @return bool|resource
 * renvoie la resource comportant tout les pneus de la marque
 */
function rechercherParMarque($marque)
{
    $marque=securite_bdd($marque);
    $sql="SELECT * FROM pneus WHERE marque='$marque'";
    return SQLSelect($sql);
}

/** rechercherParLargeur
 * @param $marque
 * @return bool|resource
 * renvoie la resource comportant tout les pneus de la largeur donnée
 */
function rechercherParLargeur($largeur)
{
    $largeur=securite_bdd($largeur);
    $sql="SELECT * FROM pneus WHERE largeur='$largeur'";
    return SQLSelect($sql);
}

/** rechercherParSerie
 * @param $marque
 * @return bool|resource
 * renvoie la resource comportant tout les pneus de la serie donnée
 */
function rechercherParSerie($serie)
{
    $serie=securite_bdd($serie);
    $sql="SELECT * FROM pneus WHERE serie='$serie'";
    return SQLSelect($sql);
}

/** rechercherParCharge
 * @param $marque
 * @return bool|resource
 * renvoie la resource comportant tout les pneus de la charge donnée
 */
function rechercherParCharge($charge)
{
    $charge=securite_bdd($charge);
    $sql="SELECT * FROM pneus WHERE charge='$charge'";
    return SQLSelect($sql);
}

/** rechercherParVitesse
 * @param $marque
 * @return bool|resource
 * renvoie la resource comportant tout les pneus de la vitesse donnée
 */
function rechercherParVitesse($vitesse)
{
    $vitesse=securite_bdd($vitesse);
    $sql="SELECT * FROM pneus WHERE charge='$vitesse'";
    return SQLSelect($sql);
}

/** rechercherMarque
 * @param $marque
 * @return bool|resource
 * Recherche toutes les marques diponibles
 */
function rechercherMarque()
{
    $sql="SELECT DISTINCT marque FROM pneus";
    return SQLSelect($sql);
}









