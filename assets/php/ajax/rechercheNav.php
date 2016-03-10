<?php

include_once "../fonctions/fonctionsBDD.php";
include_once "../fonctions/AJAX.php";


if(isset($_POST["action"]))
{
    $tabMarque = rechercherMarque();
    $i = 0;
    $tab = array();
    foreach($tabMarque as $row)
    {
        $tab[$i]= $row[0];
        $i++;
    }
    $data["marques"] = $tab;
    $data["nombre"]=count($tab);
    $data["success"] = 1;
    ajaxSuccess($data);



}



?>