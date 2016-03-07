<?php
session_start();

if (0)//TODO: implémentation de la connection au site Si mauvaise connection etc on détruis la session
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
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css"/>
    <script src="../assets/js/jquery-1.11.3.min.js"></script>
    <script src="../assets/bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css"/>
    <script src="../assets/js/script.js"></script>

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

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div id="navHeader">
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
                        <a href="#" class="dropdown-toggle">Catalogue de pneus<span
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
                        <a href="#" class="dropdown-toggle">Panier <span
                                class="fa fa-shopping-cart"
                                aria-hidden="true"></span></a>
                        <ul class="dropdown-menu" role="menu" style="width:400%;">
                            <li><a href="#">
                                <span class="item">
                                    <span class="item-left">
                                        <img src="http://placehold.it/50x50" alt=""/>
                                        <span class="item-info">
                                            <span>Item name</span>
                                            <span>23$</span>
                                        </span>
                                    </span>
                                    <span class="item-right">
                                        <button class="btn btn-danger pull-right">x</button>
                                    </span>
                                </span>
                            </a></li>
                            <li><a href="#">
                                <span class="item">
                                    <span class="item-left">
                                        <img src="http://placehold.it/50x50" alt=""/>
                                        <span class="item-info">
                                            <span>Item name</span>
                                            <span>23$</span>
                                        </span>
                                    </span>
                                    <span class="item-right">
                                        <button class="btn btn-danger pull-right">x</button>
                                    </span>
                                </span>
                                </a></li>
                            <li><a href="#">
                                <span class="item">
                                    <span class="item-left">
                                        <img src="http://placehold.it/50x50" alt=""/>
                                        <span class="item-info">
                                            <span>Item name</span>
                                            <span>23$</span>
                                        </span>
                                    </span>
                                    <span class="item-right">
                                        <button class="btn btn-danger pull-right">x</button>
                                    </span>
                                </span>
                                </a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Prix total : 999 €</li>
                            <li class="dropdown-header"><a role="button" href="" class="btn btn-order">Passer
                                    commande</a>
                            </li>
                        </ul>
                    </li>
                    <li><?php
                        /* Verifie si la personne est connécter et change le bouton en fonction */
                        if (isset($_SESSION['connecter'])) echo '<a>Mon compte';
                        else echo '<a data-placement="bottom" data-toggle="popover" data-title="Login" data-container="body" type="button" data-html="true" href="#" id="login">Se connecter ';
                        echo '<span class="fa fa-user " aria-hidden="true"></span></a>' ?>
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

        <div class="well searchWell">
            <form class="form-inline" role="form">

                <h3>Filtres de recherche : </h3>

                <label class="control-label" for="sel1">Catégorie :</label>

                <select class="form-control" id="sel1">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select>


                <label class="control-label" for="sel2">Marque:</label>

                <select class="form-control" id="sel2">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select>

                <label class="control-label" for="sel3">Largeur :</label>

                <select class="form-control" id="sel3">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select>

                <label class="control-label" for="sel5">Série :</label>

                <select class="form-control" id="sel5">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select>

                <label class="control-label" for="sel5">Diamètre :</label>

                <select class="form-control" id="sel5">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select>

                <label for="sel4">Charge :</label>

                <select class="form-control" id="sel4">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select>

                <label class="control-label" for="sel5">Vitesse :</label>

                <select class="form-control" id="sel5">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select>

                <a role="button" href="" class="btn btn-warning pull-right">Rechercher</a>

            </form>
        </div>
    </div>
</nav>


<div class="container">


