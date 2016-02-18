<?php
//include_once ("subscribe.html");
session_start();
if(0)//TODO: implémentation de la connection au site Si mauvaise connection etc on détruis la session
    session_destroy();
include_once("header.php");
if(isset($_GET["url"]))
    $choix = $_GET["url"];
else
    $choix = "";
switch($choix)
{
    case "recherche":
        include_once("recherche.html");
        break;
    case "admin":
        include_once ("Admin.html");
        break;
    case "inscription":
        include_once ("subscribe.html");
        break;
    case "monCompte":
        include_once("Mon_Compte.php");
        break;
    default: //TODO : A définir
        //include_once("accueil.php");
        break;
}
include_once("footer.html");

?>
