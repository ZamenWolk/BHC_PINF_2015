<?php
function ajaxError($message)
{
    $json["etat"] = "echec";
    $json["message"] = $message;
    echo json_encode($json);
    die();
}

function ajaxSuccess($data = null)
{
    $json["etat"] = "reussite";

    foreach ($data as $key => $value)
    {
        $json[$key] = $value;
    }

    echo json_encode($json);
    die();
}