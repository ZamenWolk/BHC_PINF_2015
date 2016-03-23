<?php
include_once("../fonctions/AJAX.php");
include_once("../fonctions/Admin.php");

session_start();

/**
 * Fichier utilisant la méthode "POST"
 * Actions possible :
 */

/**
 * "connecter"
 * Connecte un administrateur au site
 * Arguments :
 * [    "admin_id" => ID de l'administrateur à connecter
 *          OU                     *si les deux sont renseignés, l'ID est utilisée*
 *      "admin_name" => mail de l'administrateur à connecter,
 *      "password"  => mot de passe de l'administrateur à connecter ]
 * Renvoi :
 * [    "id_connecte" => id de l'administrateur connecté ]
 * Echoue si :
 *      - Aucun identifiant n'est renseigné (ni ID ni mail)                             (code MISSING_ARGUMENT)
 *      - Le mot de passe n'est pas renseigné                                           (code MISSING_ARGUMENT)
 *      - Le paramètre d'identification n'a pas permis de trouver un administrateur     (code NO_ADMIN)
 *      - Un compte est déja connecté                                                   (code ALREADY_CONNECTED)
 *      - Le mot de passe renseigné n'est pas celui de l'administrateur                 (code WRONG_PASSWORD)
 */

/**
 * "deconnecter"
 * Déconnecte l'administrateur actuellement connecte
 * Aucun argument
 * Aucun renvoi
 */

/**
 * "inscrire"
 * Inscrit un administrateur dans la base de données du système
 * Arguments :
 * [    "nom"           => Nom de l'administrateur,
 *      "password"      => Mot de passe de l'administrateur,
 *      "autorisations" => chaine JSON des autorisation de l'admin *facultatif, tableau vide par défaut*]
 * Renvoi :
 * [    "id_admin" => ID donné à l'administrateur ]
 * Echoue si :
 *      - Il manque des informations administrateur    (code MISSING_ARGUMENT)
 *      - Un administrateur à déja cette adresse mail  (code MAIL_IN_USE)
 */

/**
 * "getAdmin"
 * Récupère les informations d'un administrateur
 * Arguments :
 * [    "admin_id"   => ID de l'administrateur à connecter
 *          OU                     *si les deux sont renseignés, l'ID est utilisée*
 *      "admin_name" => mail de l'administrateur à connecter,
 *      "withPass"   => booléen, informe de la volonté ou non d'obtenir le passwordHash *facultatif, false par défaut* ]
 * Renvoi :
 * [    "admin" => Tableau des données de l'administrateur ]
 * Echoue si :
 *      - Aucun paramètre d'identification d'administrateur n'a été envoyé (code MISSING_ARGUMENT)
 *      - Aucun administrateur n'a été trouvé avec les identifiants donnés (code NO_ADMIN)
 */

/**
 * "getConnectedAdmin"
 * Récupère les informations de l'administrateur connecté
 * Arguments :
 * [    "withPass"   => booléen, informe de la volonté ou non d'obtenir le passwordHash *facultatif, false par défaut* ]
 * Renvoi :
 * [    "admin" => Informations de l'administrateur ]
 * Echoue si :
 *      - Il n'y a pas d'administrateur connecté (code NO_CONNECTED_ADMIN)
 */

/**
 * "changerInformations"
 * Change les informations d'un administrateur
 * Arguments :
 * [    "admin_id"      => ID de l'administrateur,
 *      "nom"           => Nouveau nom de l'administrateur,
 *      "autorisations" => Nouvelles autorisations de l'administrateur *facultatif, tableau vide par défaut ]
 * Aucun renvoi
 * Echoue si :
 *      - Il manque des paramètres                           (code MISSING_ARGUMENT)
 *      - L'identifiant ne correspond à aucun administrateur (code NO_ADMIN)
 */

/**
 * "changerPassword"
 * Change le mot de passe d'un administrateur
 * Arguments :
 * [    "admin_id"  => ID de l'administrateur,
 *      "old_pass" => Ancien mot de passe,
 *      "new_pass" => Nouveau mot de passe ]
 * Aucun renvoi
 * Echoue si :
 *      - Il manque des paramètres                              (code MISSING_ARGUMENT)
 *      - L'identifiant ne correspond à aucun administrateur    (code NO_ADMIN)
 *      - Le mot de passe de vérification ne correspond pas     (code WRONG_PASSWORD)
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


        if (!isset($_POST["admin_id"]) && !isset($_POST["admin_name"]))
            ajaxError("Aucun paramètre d'identification de l'administrateur reçu", "MISSING_ARGUMENT");

        if (!isset($_POST["password"]))
            ajaxError("Mot de passe non renseigné", "MISSING_ARGUMENT");

        $admin = null;
        $password = $_POST["password"];

        if (isset($_POST["admin_id"]))
            $admin = Admin::getAdminFromID($_POST["admin_id"]);
        else
            $admin = Admin::getAdminFromName($_POST["admin_name"]);

        if ($admin === false)
            ajaxError("Le paramètre d'identification ne correspond à aucun administrateur", "NO_ADMIN");

        $res = $admin->connecter($password);

        if ($res)
            ajaxSuccess(["id_connecte" => $res]);
        ajaxError("Le mot de passe renseigné est eronné", "WRONG_PASSWORD");



        break;

    case "deconnecter":

        Admin::deconnecter();
        ajaxSuccess();

        break;

    case "inscrire":

        if (!isset($_POST["nom"]) || !isset($_POST["password"]))
            ajaxError("Tous les paramètres ne sont pas renseignés", "MISSING_ARGUMENT");

        $nom = $_POST["nom"];
        $password = $_POST["password"];
        $autorisations = isset($_POST["autorisations"]) ? $_POST["autorisations"] : "{}";

        $admin = Admin::AdminFromData($nom, $password, $autorisations);

        $res = $admin->inscrireEnBDD();

        if ($res)
            ajaxSuccess(["id_admin" => $res]);
        else
            ajaxError("Un administrateur est déja inscrit avec ce nom", "NAME_IN_USE");

        break;

    case "getAdmin":

        if (!isset($_POST["admin_id"]) && !isset($_POST["admin_name"]))
            ajaxError("Aucun paramètre d'identification d'administrateur reçu", "MISSING_ARGUMENT");

        $admin = null;

        if (isset($_POST["admin_id"]))
            $admin = Admin::getAdminFromID($_POST["admin_id"]);
        else
            $admin = Admin::getAdminFromName($_POST["admin_name"]);

        if ($admin === false)
            ajaxError("Le paramètre d'identification ne correspond à aucun administrateur", "NO_ADMIN");

        $withPass = isset($_POST["withPass"]) ? $_POST["withPass"] : false;

        ajaxSuccess(["admin" => $admin->getAdmin($withPass)]);

        break;

    case "getConnectedAdmin":

        $id = Admin::getIDConnecte();

        if (!$id)
            ajaxError("Pas d'administrateur connecté", "NO_CONNECTED_ADMIN");

        $admin = Admin::getAdminFromID($id);

        $withPass = isset($_POST["withPass"]) ? $_POST["withPass"] : false;

        ajaxSuccess(["admin" => $admin->getAdmin($withPass)]);

        break;

    case "changerInformations":

        if (!isset($_POST["nom"]))
            ajaxError("Tous les paramètres ne sont pas renseignés", "MISSING_ARGUMENT");

        if (!isset($_POST["admin_id"]))
            ajaxError("Identifiant d'administrateur non reçu", "MISSING_ARGUMENT");

        $nom = $_POST["nom"];
        $password = "";
        $autorisations = isset($_POST["autorisations"]) ? $_POST["autorisations"] : "{}";

        $admin = Admin::AdminFromData($nom, $password, $autorisations);

        if($admin->modifierInformations($_POST["admin_id"]))
            ajaxSuccess();
        else
            ajaxError("Le paramètre d'identification ne correspond à aucun administrateur", "NO_ADMIN");

        break;

    case "changerPassword":

        if (!isset($_POST["old_pass"]) || !isset($_POST["new_pass"]) || !isset($_POST["admin_id"]))
            ajaxError("Tous les paramètres ne sont pas renseignés", "MISSING_ARGUMENT");

        $old_pass = $_POST["old_pass"];
        $new_pass = $_POST["new_pass"];
        $admin_id = $_POST["admin_id"];


        $res = Admin::changePassword($old_pass, $new_pass, $admin_id);

        if ($res === true)
        {
            ajaxSuccess();
        }
        else
        {
            if (Admin::getAdminFromID($admin_id) === false)
                ajaxError("Le paramètre d'identification ne correspond à aucun administrateur", "NO_ADMIN");
            else
                ajaxError("L'ancien mot de passe ne correspond pas", "WRONG_PASSWORD");
        }

        break;

    default:
        ajaxError("Action inconnue");
}