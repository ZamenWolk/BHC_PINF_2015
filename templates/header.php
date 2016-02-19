<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TODO supply a title</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/flat-ui.css">
    <script src="js/script.js"></script>
    <link href="css/checkbox.css" rel="stylesheet">
    <style>
        body {
            background: url(04.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .panel {
            border: outset 2px;
        }

    </style>
    <script>
        $(document).ready( function(){

            /* Ici on gére les événements de click sur le bouton du header se connecter/ s'inscrire */
            $("#btn-connect").click(function(){
                   // console.log($("#btn-connect").html());
                   if( $("#btn-connect").html()=="Se connecter  <span class=\"glyphicon glyphicon-user \" aria-hidden=\"true\"></span>")
                        document.location.href = "?url=connection";//Rediriger vers la connection
                   else
                        document.location.href = "?url=monCompte";//rediriger vers Mon compte il faudrait inclure des sécurités dans la page mon compte
                // ex : verifier que l'utiliateur est bien connecté si non on le redirige
                });
        });
    </script>

</head>

<body>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-1 ">
            <img id="logo" src="ressources/logo.svg"/>
        </div>
        <div class="col-md-3 col-md-offset-1" >
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher...">
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                 </span>

            </div>

        </div>
        <div class="col-md-2 col-md-offset-2">

            <button type="button" id="btn-connect" class="btn btn-default"><?php
                /* Verifie si la personne est connécter et change le bouton en fonction */
                if(isset($_SESSION['connecter'])) echo "Mon compte"; else echo "Se connecter";?>  <span class="glyphicon glyphicon-user " aria-hidden="true"></span></button>


        </div>
        <div class="col-md-2 ">
            <button class="btn btn-default">Mon panier   <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
        </div>
    </div>
    <div class="row">
        <div class="navbar navbar-default navbar-static-top">
            <ul class="nav navbar-nav">
                <li class="active"> <a href="?url=accueil">Accueil</a> </li>
                <li> <a href="#">Pneus Auto</a> </li>
                <li> <a href="#">Pneus Poids Lourd</a> </li>
                <li> <a href="#">Pneus Moto</a> </li>
            </ul>
        </div>
    </div>





