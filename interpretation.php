<?php
include_once "lib/fonctionsBDD.php";
include_once "lib/maLibUtils.php";
session_start();
$action = $_POST['action'];/* Le boutton submit doit avoir comme nom : action avec des valeurs différentes
echo $action;
/* Page où l'on va traiter les formulaires d'inscription et connexions, etc */
switch($action)
{
    /* Inscription */
    case 'subscribe':
        //echo $_POST['ins_mail'],$_POST['ins_password'],$_POST['ins_nom'],$_POST['ins_prenom'];
        /* TODO : rajouter les protections sur les entrés de l'utilisateur */
        mkUser($_POST['ins_mail'],$_POST['ins_password'],$_POST['ins_nom'],$_POST['ins_prenom']);
        header("Location:index.php?url=connection");
        die();// On arréte l'interpretation du code
        break;
    case 'connection':
        /* TODO : rajouter les protections sur les entrés de l'utilisateur */
        echo $_POST['conn_mail'],$_POST['conn_password'];
        if(isset($_POST['conn_mail']) && isset($_POST['conn_password']) ) {
            if($_POST['conn_mail'] != NULL && $_POST['conn_password']!= NULL) {
                $mail = addslashes($_POST['conn_mail']);//Protection contre les entrées de l'utilisateur
                $mdp = addslashes($_POST['conn_password']);//Protection contre les entrées de l'utilisateur

                $sql = "SELECT user_password FROM users WHERE user_mail='$mail'";//On pourrait faire un SELECT *
                $sql2 = "SELECT user_id FROM users WHERE user_mail='$mail'";
                $mdpSql = SQLGetChamp($sql);
                //tprint($select);
                if(password_verify($mdp,$mdpSql)) //Si la fonction nous renvoie c'est ok on se connecte
                {
                    $_SESSION['connecter'] = 1;
                    $_SESSION['user_mail']= $mail;
                    $_SESSION['user_id'] = SQLGetChamp($sql2);
                    connecte($_SESSION['user_id']);//peux poser problème quand l'utilisateur quitte son navigateur
                    header("Location:index.php?url=accueil");
                }
                else //sinon on revient à la page de connection
                    header("Location:index.php?url=connection&err=1");
            }
            else
                echo "Un champs n'est pas remplit";
            die();
        }
        break;
    case "deconnection":
        deconnecte($_SESSION['user_id']);
        session_unset();
        session_destroy();
        header("Location:index.php?url=accueil");
        die();
        break;
    default:
        break;
}