<?php
include_once "lib/fonctionsBDD.php";
session_start();
$action = $_POST['action'];/* Le boutton submit doit avoir comme nom : action avec des valeurs différentes
echo $action;
/* Page où l'on va traiter les formulaire, etc */
switch($action)
{
    /* Inscription */
    case 'subscribe':
        mkUser($_POST['ins_mail'],$_POST['ins_password'])
        break;
}