<?php
/**
	*  
	* @brief émet un code d'erreur et un message d'état d'échec
	* @param string message le message d'erreur
	* @param string errorCode code d'erreur (aide au débug)
	*
**/
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

/**
	*  
	* @brief émet  un message d'état de réussite
	* @param array data contient des informations au format json avec entre autre un code d'état de réussite
	*
	**/
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

/**
	*  
	* @brief émet un code d'avertissement et un message d'état warning
	* @param string message le message d'avertissement
	* @param data array contient les informations en format json
	* @param string warningCode code d'avertissement (aide au débug)
	*
	**/
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