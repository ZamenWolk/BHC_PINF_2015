<?php
function ajaxError($message)
{
    $json = array();
    $json["etat"] = "echec";
    $json["message"] = $message;
    echo json_encode($json);
    die();
}

function ajaxSuccess($data = null)
{
    $json = array();
    $json["etat"] = "reussite";

    foreach ($data as $key => $value)
    {
        $json[$key] = $value;
    }

    echo json_encode($json);
    die();
}

function ajaxWarning($message, $data = null)
{
    $json = array();
    $json["etat"] = "warning";
    $json["message"] = $message;

    foreach ($data as $key => $value)
    {
        $json[$key] = $value;
    }

    echo json_encode($json);
    die();
}