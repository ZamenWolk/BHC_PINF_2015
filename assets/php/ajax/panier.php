<?php

/**
 * TODO écrire la documentation
 */

$json = array();

if (!isset($_GET["action"]))
{
    $json["stat"] = "fail";
    $json["message"] = '"action" est vide';
    echo json_encode($json);
    die();
}

$action = $_GET["action"];

switch ($action)
{
    case "ajouterArticle":
        if (!isset($_GET["referencePneu"]))
        {
            $json["stat"] = "fail";
            $json["message"] = '"referencePneu" est vide';
        }
}