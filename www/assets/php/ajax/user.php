<?php

include_once "../../../secret/credentials.php";
include_once("../fonctions/AJAX.php");
include_once("../fonctions/User.php");

session_start();

/**
 * Fichier utilisant la méthode "POST"
 * Actions possible :
 */

/**
 * "connecter"
 * Connecte un utilisateur au site
 * Arguments :
 * [    "user_id" => ID de l'utilisateur à connecter
 *          OU                     *si les deux sont renseignés, l'ID est utilisée*
 *      "user_mail" => mail de l'utilisateur à connecter,
 *      "password"  => mot de passe de l'utilisateur à connecter ]
 * Renvoi :
 * [    "id_connecte" => id de l'utilisateur connecté ]
 * Echoue si :
 *      - Aucun identifiant n'est renseigné (ni ID ni mail)                         (code MISSING_ARGUMENT)
 *      - Le mot de passe n'est pas renseigné                                       (code MISSING_ARGUMENT)
 *      - Le paramètre d'identification n'a pas permis de trouver un utilisateur    (code NO_USER)
 *      - Un compte est déja connecté                                               (code ALREADY_CONNECTED)
 *      - Le mot de passe renseigné n'est pas celui de l'utilisateur                (code WRONG_PASSWORD)
 */

/**
 * "deconnecter"
 * Déconnecte l'utilisateur actuellement connecte
 * Aucun argument
 * Aucun renvoi
 */

/**
 * "inscrire"
 * Inscrit un utilisateur dans la base de données du système
 * Arguments :
 * [    "nom"        => Nom de l'utilisateur,
 *      "prenom"     => Prénom de l'utilisateur,
 *      "mail"       => Adresse mail de l'utilisateur,
 *      "password"   => Mot de passe de l'utilisateur,
 *      "newsletter" => Abonnement à la newsletter de l'utilisateur,
 *      "telephone"  => Numéro de téléphone de l'utilisateur ]
 * Renvoi :
 * [    "id_user" => ID donné à l'utilisateur ]
 * Echoue si :
 *      - Il manque des informations utilisateur    (code MISSING_ARGUMENT)
 *      - Un utilisateur à déja cette adresse mail  (code MAIL_IN_USE)
 */

/**
 * "getUser"
 * Récupère les informations d'un utilisateur
 * Arguments :
 * [    "user_id" => ID de l'utilisateur à connecter
 *          OU                     *si les deux sont renseignés, l'ID est utilisée*
 *      "user_mail" => mail de l'utilisateur à connecter,
 *      "withPass"   => booléen, informe de la volonté ou non d'obtenir le passwordHash *facultatif, false par défaut* ]
 * Renvoi :
 * [    "user" => Tableau des données de l'utilisateur ]
 * Echoue si :
 *      - Aucun paramètre d'identification d'utilisateur n'a été envoyé (code MISSING_ARGUMENT)
 *      - Aucun utilisateur n'a été trouvé avec les identifiants donnés (code NO_USER)
 */

/**
 * "getConnectedUser"
 * Récupère les informations de l'utilisateur connecté
 * Arguments :
 * [    "withPass"   => booléen, informe de la volonté ou non d'obtenir le passwordHash *facultatif, false par défaut* ]
 * Renvoi :
 * [    "user" => Informations de l'utilisateur ]
 * Echoue si :
 *      - Il n'y a pas d'utilisateur connecté (code NO_CONNECTED_USER)
 */

/**
 * "changerInformations"
 * Change les informations d'un utilisateur
 * Arguments :
 * [    "user_id"    => ID de l'utilisateur,
 *      "nom"        => Nouveau nom de l'utilisateur,
 *      "prenom"     => Nouveau prénom de l'utilisateur,
 *      "mail"       => Nouveau mail de l'utilisateur,
 *      "newsletter" => Nouvelle newsletter de l'utilisateur,
 *      "telephone"  => Nouveau numéro de téléphone de l'utilisateur ]
 * Aucun renvoi
 * Echoue si :
 *      - Il manque des paramètres                        (code MISSING_ARGUMENT)
 *      - L'identifiant ne correspond à aucun utilisateur (code NO_USER)
 */

/**
 * "changerPassword"
 * Change le mot de passe d'un utilisateur
 * Arguments :
 * [    "user_id"  => ID de l'utilisateur,
 *      "old_pass" => Ancien mot de passe,
 *      "new_pass" => Nouveau mot de passe ]
 * Aucun renvoi
 * Echoue si :
 *      - Il manque des paramètres                          (code MISSING_ARGUMENT)
 *      - L'identifiant ne correspond à aucun utilisateur   (code NO_USER)
 *      - Le mot de passe de vérification ne correspond pas (code WRONG_PASSWORD)
 */

if (!isset($_POST["action"]))
{
    ajaxError("Action non définie");
}

$action = $_POST["action"];

switch ($action)
{
    case "connecter":

        if (isset($_SESSION["connexion"]))
            if (array_key_exists("connecte", $_SESSION["connexion"]))
                ajaxError("Un compte est déja connecté", "ALREADY_CONNECTED");


        if (!isset($_POST["user_id"]) && !isset($_POST["user_mail"]))
            ajaxError("Aucun paramètre d'identification de l'utilisateur reçu", "MISSING_ARGUMENT");

        if (!isset($_POST["password"]))
            ajaxError("Mot de passe non renseigné", "MISSING_ARGUMENT");

        $user = null;
        $password = $_POST["password"];

        if (isset($_POST["user_id"]))
            $user = User::getUserFromID($_POST["user_id"]);
        else
            $user = User::getUserFromMail($_POST["user_mail"]);

        if ($user === false)
            ajaxError("Le paramètre d'identification ne correspond à aucun utilisateur", "NO_USER");

        $res = $user->connecter($password);

        if ($res)
            ajaxSuccess(["id_connecte" => $res]);
        ajaxError("Le mot de passe renseigné est eronné", "WRONG_PASSWORD");



        break;

    case "deconnecter":

        User::deconnecter();
        ajaxSuccess();

        break;

    case "inscrire":

        if (!isset($_POST["nom"]) || !isset($_POST["prenom"]) || !isset($_POST["mail"]) || !isset($_POST["password"]) || !isset($_POST["newsletter"]) || !isset($_POST["telephone"]))
            ajaxError("Tous les paramètres ne sont pas renseignés", "MISSING_ARGUMENT");

        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $mail = $_POST["mail"];
        $password = $_POST["password"];
        $newsletter = $_POST["newsletter"];
        $telephone = $_POST["telephone"];

        $user = User::UserFromData($nom, $prenom, $mail, $password, $newsletter, $telephone);

        $res = $user->inscrireEnBDD();

        if ($res)
            ajaxSuccess(["id_user" => $res]);
        else
            ajaxError("Un utilisateur est déja inscrit avec cette adresse mail", "MAIL_IN_USE");

        break;

    case "getUser":

        if (!isset($_POST["user_id"]) && !isset($_POST["user_mail"]))
            ajaxError("Aucun paramètre d'identification d'utilisateur reçu", "MISSING_ARGUMENT");

        $user = null;

        if (isset($_POST["user_id"]))
            $user = User::getUserFromID($_POST["user_id"]);
        else
            $user = User::getUserFromMail($_POST["user_mail"]);

        if ($user === false)
            ajaxError("Le paramètre d'identification ne correspond à aucun utilisateur", "NO_USER");

        $withPass = isset($_POST["withPass"]) ? $_POST["withPass"] : false;

        ajaxSuccess(["user" => $user->getUser($withPass)]);

        break;

    case "getConnectedUser":

        $id = User::getIDConnecte();

        if (!$id)
            ajaxError("Pas d'utilisateur connecté", "NO_CONNECTED_USER");

        $user = User::getUserFromID($id);

        $withPass = isset($_POST["withPass"]) ? $_POST["withPass"] : false;

        ajaxSuccess(["user" => $user->getUser($withPass)]);

        break;

    case "changerInformations":

        if (!isset($_POST["nom"]) || !isset($_POST["prenom"]) || !isset($_POST["mail"]) || !isset($_POST["newsletter"]))
            ajaxError("Tous les paramètres ne sont pas renseignés", "MISSING_ARGUMENT");

        if (!isset($_POST["user_id"]))
            ajaxError("Identifiant d'utilisateur non reçu", "MISSING_ARGUMENT");

        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $mail = $_POST["mail"];
        $password = "";
        $newsletter = $_POST["newsletter"];
        $telephone = $_POST["telephone"];

        $user = User::UserFromData($nom, $prenom, $mail, $password, $newsletter, $telephone);

        if($user->modifierInformations($_POST["user_id"])) {
            ajaxSuccess(array("succes" => 1));
        }
        else
            ajaxError("Le paramètre d'identification ne correspond à aucun utilisateur", "NO_USER");

        break;

    case "changerPassword":

        if (!isset($_POST["old_pass"]) || !isset($_POST["new_pass"]) || !isset($_POST["user_id"]))
            ajaxError("Tous les paramètres ne sont pas renseignés", "MISSING_ARGUMENT");

        $old_pass = $_POST["old_pass"];
        $new_pass = $_POST["new_pass"];
        $user_id = $_POST["user_id"];


    $res = User::changePassword($old_pass, $new_pass, $user_id);

        if ($res === true)
        {
            ajaxSuccess();
        }
        else
        {
            if (User::getUserFromID($user_id) === false)
                ajaxError("Le paramètre d'identification ne correspond à aucun utilisateur", "NO_USER");
            else
                ajaxError("L'ancien mot de passe ne correspond pas", "WRONG_PASSWORD");
        }

        break;

    default:
        ajaxError("Action inconnue");
}