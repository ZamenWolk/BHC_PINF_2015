<?php
include_once "maLibSQL.pdo.php";


function mkUser($mail, $mdp, $nom, $prenom)//Permet la création d'un utilisateur fonctionnelle
{
    $mail=addslashes($mail);
    $nom=addslashes($nom);
    $prenom=addslashes($prenom);
    $mdp=addslashes($mdp);
    $mdp=password_hash($mdp, PASSWORD_BCRYPT);
    //echo $mdp;
    $sql="INSERT INTO users(user_mail, user_password, user_nom, user_prenom) VALUES ('$mail','$mdp','$nom','$prenom')";
    SQLInsert($sql);
}

function connecte($idUser)// Place à 1 la variable "connecté" dans la base de données, utilise l'id de l'utilisateur
{
    $sql= "  UPDATE users
              SET user_connecte=1
             WHERE user_id='$idUser'";
    SQLUpdate($sql);
}

function deconnecte($idUser)//Place à 0 la variable "connecté" dans la base de données, utilise l'id de l'utilisateur
{
    $sql= "  UPDATE users
              SET user_connecte=0
             WHERE user_id='$idUser'";
    SQLUpdate($sql);
}

function modifNom($mail, $nom)//Permet de modifier le nom de famille par rapport au mail
{
    $sql= "  UPDATE users
              SET user_nom='$nom'
             WHERE user_mail='$mail'";
    SQLUpdate($sql);
}

function modifPrenom($mail, $prenom)//Permet de modifier le prénom
{
    $sql= "  UPDATE users
              SET user_prenom='$prenom'
             WHERE user_mail='$mail'";
    SQLUpdate($sql);
}