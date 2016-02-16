<?php
//include_once ("subscribe.html");
include_once("header.html");
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
    default: //TODO : A définir
        //include_once("");
        break;
}
include_once("footer.html");

?>
