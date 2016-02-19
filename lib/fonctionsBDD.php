<?php
function mkUser($mail, $mdp, $nom, $prenom)//Permet la création d'un utilisateur fonctionnelle
{
    $mail=addslashes($mail);
    $nom=addslashes($nom);
    $prenom=addslashes($prenom);
    $mdp=addslashes($mdp);
    $mdp=password_hash($mdp, PASSWORD_BCRYPT);
    echo $mdp;
    $sql="INSERT INTO users(user_mail, user_password, user_nom, user_prenom) VALUES ('$mail','$mdp','$nom','$prenom')";
    SQLInsert($sql);
}