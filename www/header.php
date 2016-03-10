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
    <script src="../assets/js/jquery-2.2.1.min.js"></script>
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
        /* Charge la recherche dans la navbar
         * Pour l'instant seulement la marque*/
        $(document).ready(function () {
            $.post("../assets/php/ajax/rechercheNav.php", {action: "chargement"}, function (data) {
                data = JSON.parse(data);
                console.log(data);
                //alert( "Load was performed."+ data );
                for (var i = 0; i < data.nbrMarque; i++) {
                    var option = $("<option>" + data.marques[i] + "</option>");
                    $(".nav_marque").append(option);
                }

                for (i = 0; i < data.nbrCategorie; i++) {
                    var option1 = $("<option>" + data.categorie[i] + "</option>");
                    $(".nav_categorie").append(option1);
                }

                for (i = 0; i < data.nbrCharge; i++) {
                    var option2 = $("<option>" + data.charge[i] + "</option>");
                    $(".nav_charge").append(option2);
                }

                for (i = 0; i < data.nbrJante; i++) {
                    var option3 = $("<option>" + data.jante[i] + "</option>");
                    $(".nav_jante").append(option3);
                }
                for (i = 0; i < data.nbrSerie; i++) {
                    var option4 = $("<option>" + data.serie[i] + "</option>");
                    $(".nav_serie").append(option4);
                }

                for (i = 0; i < data.nbrVitesse; i++) {
                    var option5 = $("<option>" + data.vitesse[i] + "</option>");
                    $(".nav_vitesse").append(option5);
                }
                for (i = 0; i < data.nbrLargeur; i++) {
                    var option6 = $("<option>" + data.largeur[i] + "</option>");
                    $(".nav_largeur").append(option6);
                }

            });

        });
    </script>

    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js">
    </script>
    <!-- FIN PANNEAU D'AFFICHAGE D'UTILISATION DE COOKIE- -->

</head>

<body>

<nav id="navHeader" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#headNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="./accueil" class="navbar-brand"><img id="logo" src="../assets/img/logo.svg"/></a>
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
                <li><a href="./contact">Contact</a></li>
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
                    else echo '<a data-placement="bottom" data-toggle="popover" data-title="Connexion" data-container="body" type="button" data-html="true" href="#" id="login">Se connecter ';
                    echo '<span class="fa fa-user " aria-hidden="true"></span></a>' ?>
                </li>
                <li id="popover-content" class="hide">
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <input id="mailLogin" type="email" class="form-control" name="mail"
                                   placeholder="Adresse Mail">
                        </div>
                        <div class="form-group">
                            <input id="passeLogin" type="password" class="form-control" name="password"
                                   placeholder="Mot de passe">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-block btn-connect">Se connecter</button>
                    </form>
                    <div class="subLink">
                        <a data-toggle="modal" data-target="#myModal">Pas encore inscrit ?</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid searchWell">
        <form action="./recherche" class="form-inline searchForm" role="form" method="post">

            <h3>Filtres de recherche : </h3>

            <label  class="control-label" for="sel1">Catégorie :</label>

            <select name="categorie" class="form-control nav_categorie" id="sel1">
                <option>Tous</option>
            </select>


            <label  class="control-label" for="sel2">Marque:</label>

            <select name="marque" class="form-control nav_marque" id="sel2">
                <option>Toutes</option>
            </select>

            <label class="control-label" for="sel3">Largeur :</label>

            <select name="largeur"  class="form-control nav_largeur" id="sel3">
                <option>Toutes</option>
            </select>

            <label class="control-label" for="sel5">Série :</label>

            <select name="serie" class="form-control nav_serie" id="sel5">
                <option>Toutes</option>
            </select>

            <label  class="control-label" for="sel5">Jante :</label>

            <select name="jante" class="form-control nav_jante" id="sel5">
                <option>Tous</option>
            </select>

            <label for="sel4">Charge :</label>

            <select name="charge" class="form-control nav_charge" id="sel4">
                <option>Toutes</option>
            </select>

            <label class="control-label" for="sel5">Vitesse :</label>

            <select name="vitesse" class="form-control nav_vitesse" id="sel5">
                <option>Toutes</option>
            </select>

            <input type="submit" value="Rechercher" class="btn btn-warning pull-right">

        </form>
    </div>
</nav>

<div class="warper">
    <div class="container main">


