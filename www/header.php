<?php
session_start();

if(0)//TODO: implémentation de la connection au site Si mauvaise connection etc on détruis la session
    session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JS Pneus</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css"/>
    <script src="../assets/js/jquery-1.11.3.min.js"></script>
    <script src="../assets/bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css"/>
    <script src="../assets/js/script.js"></script>
    <style>

        .btn-connect {
            background: none;
            border-left-style: none;
        }

        .btn-search-highlight {
            border-right-style: solid;
            border-right-color: #2ecc71;

            border-top-style: solid;
            border-top-color: #2ecc71;

            border-bottom-style: solid;
            border-bottom-color: #2ecc71;
        }

    </style>
    <!-- PANNEAU D'AFFICHAGE D'UTILISATION DE COOKIE-->
    <script type="text/javascript">
        window.cookieconsent_options = {
            "message": "Ce site contient des cookies qui sont utilisés dans le but d'améliorer votre expérience de navigation.",
            "dismiss": "D'accord",
            "learnMore": "Plus d'informations",
            "link": null,
            "theme": "dark-bottom"
        };
        //Le "Link" peut être changé pour un lien de police d'utilisation des cookies à générer ou à faire soi même
        //Le thème est changeable en fonction de la disposition ou de la couleur.
    </script>

    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
    <!-- FIN PANNEAU D'AFFICHAGE D'UTILISATION DE COOKIE- -->

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top" id="navHeader">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="?url=accueil" class="navbar-brand"><img id="logo" src="../assets/img/logo.svg"/></a>
        </div>
        <div class="collapse navbar-collapse" id="headNavbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catalogue de pneus<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" style="width:120%;">
                        <li><a href="#">Catégorie 1</a></li>
                        <li><a href="#">Catégorie 2</a></li>
                        <li><a href="#">Catégorie 3</a></li>
                    </ul>
                </li>
                <li>
                    <a id="searchLink">Recherche</a>
                </li>
                <li><a href="#">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="">Panier<span class="glyphicon glyphicon-shopping-cart"
                                           aria-hidden="true"></span></a>
                    <ul class="dropdown-menu" role="menu" style="width:400%;">
                        <li><a href="#">Article 1</a></li>
                        <li><a href="#">Article 2</a></li>
                        <li><a href="#">Article 3</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Prix total : 999 €</li>
                        <li class="dropdown-header"><a role="button" href="" class="btn btn-warning">Passer
                                commande</a>
                        </li>
                    </ul>
                </li>
                <li><?php
                    /* Verifie si la personne est connécter et change le bouton en fonction */
                    if (isset($_SESSION['connecter'])) echo '<a>Mon compte';
                    else echo '<a data-placement="bottom" data-toggle="popover" data-title="Login" data-container="body" type="button" data-html="true" href="#" data-trigger="focus" id="login">Se connecter';
                    echo '<span class="glyphicon glyphicon-user " aria-hidden="true"></span></a>' ?>
                </li>
                <li id="popover-content" class="hide">
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <input type="email" class="form-control" name="mail" placeholder="Adresse Mail">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password"
                                   placeholder="Mot de passe">
                        </div>
                        <button type="submit" class="btn btn-default">Se connecter</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="well searchWell">
    <form class="form-inline" role="form" style="margin-top: 60px;">

        <label for="sel1">Catégorie :</label>

        <select class="selectpicker" data-style="btn-primary" id="sel1">
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Relish</option>
        </select>



        <label for="sel2">Marque:</label>

        <select class="selectpicker" data-style="btn-primary" id="sel2">
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Relish</option>
        </select>

        <label for="sel3">Largeur :</label>

        <select class="selectpicker" data-style="btn-primary" id="sel3">
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Relish</option>
        </select>

        <label for="sel4">Hauteur :</label>

        <select class="selectpicker" data-style="btn-primary" id="sel4">
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Relish</option>
        </select>

        <label for="sel5">Diamètre :</label>

        <select class="selectpicker" data-style="btn-primary" id="sel5">
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Relish</option>
        </select>

        <a role="button" href="" class="btn btn-warning pull-right">Rechercher</a>

    </form>
</div>

<div class="container">


