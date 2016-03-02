<?php
//include_once ("subscribe.html");
session_start();
if(0)//TODO: implémentation de la connection au site Si mauvaise connection etc on détruis la session
    session_destroy();
include_once("templates/header.php");
if(isset($_GET["url"]))
    $choix = $_GET["url"];
else
    $choix = "";
switch($choix)
{
    case "accueil":
        include_once ("templates/accueil.php");
        break;
    case "recherche":
        include_once("templates/recherche.php");
        break;
    case "admin":
        include_once ("templates/Admin.html");
        break;
    case "connection":
        include_once ("templates/connection.php");
        break;
    case "inscription":
        include_once ("templates/subscribe.html");
        break;
    case "monCompte":
        include_once("templates/mon_compte.php");
        break;
    default: //TODO : A définir
        include_once("templates/accueil.php");
        break;
}
include_once("templates/footer.html");

?>
