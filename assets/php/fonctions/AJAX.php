<?php
function ajaxError($message, $errorCode = "")
{
    $json = array();
    $json["etat"] = "echec";
    $json["message"] = $message;

    if ($errorCode !== null)
        $json["code"] = $errorCode;

    echo json_encode($json);
    die();
}

function ajaxSuccess($data = array())
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

function ajaxWarning($message, $data = array(), $warningCode = "")
{
    $json = array();
    $json["etat"] = "warning";
    $json["message"] = $message;

    if ($warningCode !== null)
        $json["code"] = $warningCode;

    foreach ($data as $key => $value)
    {
        $json[$key] = $value;
    }

    echo json_encode($json);
    die();
}