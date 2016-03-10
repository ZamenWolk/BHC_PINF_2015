<?php

if (!isset($_POST["action"]))
{
    ajaxError("Action non définie");
}

$action = $_POST["action"];

switch ($action)
{
    default:
        ajaxError("Action inconnue");
}