<?php
session_start();
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
    <link rel="icon" href="../assets/img/logo_smallv2.png">
    <script src="../assets/js/jquery-2.2.1.min.js"></script>
    <script src="../assets/bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css"/>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/panier.js"></script>

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
         * Pour l'instant seulement la marque
         */
        $(document).ready(function () {
            $("#wrong_id").hide();

            $.post("../assets/php/ajax/rechercheNav.php", {action: "chargement"}, function (data) {
                data = JSON.parse(data);
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
                for (i = 0; i < data.nbrDecibel; i++) {
                    var option7 = $("<option>" + data.decibel[i] + "</option>");
                    $(".nav_decibel").append(option7);
                }
                for (i = 0; i < data.nbrConso; i++) {
                    var option8 = $("<option>" + data.consommation[i] + "</option>");
                    $(".nav_consommation").append(option8);
                }
            });


            /* ------ Connexion ------ */

            var mailLogin;
            var passeLogin;

            $(document).on("change", "#mailLogin", function () {
                mailLogin = $(this).val();
            });

            $(document).on("change", "#passeLogin", function () {
                passeLogin = $(this).val();
            });


            var connection = function () {
                $.post("../assets/php/ajax/user.php", {
                    action: "connecter",
                    user_mail: mailLogin,
                    password: passeLogin
                }, function (data) {
                    data = JSON.parse(data);
                    console.log(data);

                    /* on enlève le popover*/
                    if (data.etat == "reussite") {
                        $(".popover").popover('hide');
                    }


                    /*On enlève  le message d'erreur */
                    $('div#wrong_id').hide("slow");


                    if (data.etat == "echec") {
                        $.post("../assets/php/ajax/admin.php", {
                            action: "connecter",
                            admin_name: mailLogin,
                            password: passeLogin
                        }, function (data) {
                            data = JSON.parse(data);
                            if (data.etat == "reussite") {
                                $(".popover").popover('hide');
                                $('div#wrong_id').hide(); // L'utilisateur est maintenant connecté il faut gérer les boutons, etc
                                $("#login").attr("data-original-title", "Mon compte").html('Mon compte <span class="fa fa-user " aria-hidden="true"></span>');
                                var jQ = $('<a href="#" id="acc_dec">Se deconnecter </a><i class="fa fa-sign-out fa-fw"></i>');
                                document.location.href = "./admin";
                                $("#popover-content").html(jQ);
                            }
                            else {
                                $('div#wrong_id').show("slow");
                            }
                        });

                    }
                    else {
                        $('div#wrong_id').hide(); // L'utilisateur est maintenant connecté il faut gérer les boutons, etc
                        $("#login").attr("data-original-title", "Mon compte").html('Mon compte <span class="fa fa-user " aria-hidden="true"></span>');
                        var jQ = $('<a href="./compte" id="acc_inf">Mes informations </a><i class="fa fa-info fa-fw"></i><br>' +
                            '<a href="./historique" id="acc_cmd">Mes commandes </a><i class="fa fa-line-chart fa-fw"></i><br>' +
                            '<a href="#" id="acc_dec">Se deconnecter </a><i class="fa fa-sign-out fa-fw"></i>');
                        $("#popover-content").html(jQ);
                    }
                });
            };

            $(document).on("click", "#seConnecter", function () {
                connection();
            });

            $(document).on("keydown", function(e) {
                if(e.keyCode == 13 && $(".popover").is(":visible")) {
                    console.log(mailLogin, passeLogin);
                    connection();
                }
            });


            $.post("../assets/php/ajax/user.php", {action: "getConnectedUser"}, function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (data.etat == "echec") {
                    $.post("../assets/php/ajax/admin.php", {action: "getConnectedAdmin"}, function (data) {
                        data = JSON.parse(data);
                        console.log(data);
                        if (data.etat == "echec") {
                            $.post("../assets/php/ajax/user.php", {
                                action: "connecter",
                                user_mail: "test",
                                password: "test"
                            }, function (data2) {
                                data2 = JSON.parse(data2);
                                console.log(data2);
                                if (data2.etat == "echec" && data2.code == "ALREADY_CONNECTED") {
                                    $.post("../assets/php/ajax/user.php", {action: "deconnecter"});
                                }
                            });
                        } else {
                            $("#login").attr("data-original-title", "Mon compte").html('Mon compte <span class="fa fa-user " aria-hidden="true"></span>');
                            var jQ = $('<a href="#" id="acc_dec">Se deconnecter </a><i class="fa fa-sign-out fa-fw"></i>');
                            $("#popover-content").html(jQ);
                        }
                    });
                } else {
                    $("#login").attr("data-original-title", "Mon compte").html('Mon compte <span class="fa fa-user " aria-hidden="true"></span>');
                    var jQ = $('<a href="./compte" id="acc_inf">Mes informations </a><i class="fa fa-info fa-fw"></i><br>' +
                        '<a href="./historique" id="acc_cmd">Mes commandes </a><i class="fa fa-line-chart fa-fw"></i><br>' +
                        '<a href="#" id="acc_dec">Se deconnecter </a><i class="fa fa-sign-out fa-fw"></i>');
                    $("#popover-content").html(jQ);
                }

            });
            /* Deconnexion */
            $(document).on("click", "a#acc_dec", function () {
                console.log("deco");
                $.post("../assets/php/ajax/user.php", {action: "deconnecter"});
                setTimeout(
                    function () {
                        document.location = "./accueil";
                    }, 50);
            });


            /* ----- inscription -----*/

            //Variable ou on stocke les information d'inscription
            var ins_mail;
            var ins_password;
            var ins_password2;
            var ins_nom;
            var ins_prenom;
            var ins_postal;
            var ins_adress;
            var ins_ville;
            var ins_tel;
            var ins_comp_adress;
            /* Actualisation des variables */
            $(document).on("change", "#ins_mail", function () {
                ins_mail = $(this).val();
            });
            $(document).on("change", "#ins_password", function () {
                ins_password = $(this).val();
            });
            $(document).on("change", "#ins_phone", function () {
                ins_tel = $(this).val();
            });
            $(document).on("change", "#ins_password2", function () {
                ins_password2 = $(this).val();
            });
            $(document).on("change", "#ins_nom", function () {
                ins_nom = $(this).val();
            });
            $(document).on("change", "#ins_prenom", function () {
                ins_prenom = $(this).val();
            });
            $(document).on("change", "#ins_adress", function () {
                ins_adress = $(this).val();
            });
            $(document).on("change", "#ins_comp_adress", function () {
                ins_comp_adress = $(this).val();
            });
            $(document).on("change", "#ins_postal", function () {
                ins_postal = $(this).val();
            });
            $(document).on("change", "#ins_ville", function () {
                ins_ville = $(this).val();
            });
            var ins_id;

            /* Requête asynchrone pour inscription */
            $(document).on("click", "#ins_submit", function () {
                var newsletter = 0;
                if ($('#checkbox2').prop('checked')) {
                    if ($('#checkbox1').prop('checked'))
                        newsletter = 1;
                    /*  "nom"        => Nom de l'utilisateur,
                     *      "prenom"     => Prénom de l'utilisateur,
                     *      "mail"       => Adresse mail de l'utilisateur,
                     *      "password"   => Mot de passe de l'utilisateur,
                     *      "newsletter" => Abonnement à la newsletter de l'utilisateur ]*/
                    if (ins_password == ins_password2) {
                        $.post("../assets/php/ajax/user.php", {
                            action: "inscrire",
                            nom: ins_nom,
                            prenom: ins_prenom,
                            mail: ins_mail,
                            password: ins_password,
                            newsletter: newsletter,
                            telephone: ins_tel
                        }, function (data) {
                            data = JSON.parse(data);
                            console.log(data);
                            if (data.etat == "echec") {
                                switch (data.code) {
                                    case "MISSING_ARGUMENT":
                                        $("#ins_alert_success").hide('slow');
                                        $("#ins_alert_mail").hide('slow');
                                        break;
                                    case "MAIL_IN_USE":
                                        $("#ins_alert_mail").show('slow');
                                        $("#ins_alert_success").hide('slow');
                                        break;
                                    default:
                                        break;
                                }
                            }
                            else
                                $("#ins_alert_succes").show('slow');

                            $.post("../assets/php/ajax/adresse.php", {
                                action: "inscrireAdresse",
                                adresse_ligne1: ins_adress,
                                adresse_ligne2: ins_comp_adress,
                                adresse_codeP: ins_postal,
                                adresse_ville: ins_ville,
                                user_id: data["id_user"]
                            }, function (data) {
                                data = JSON.parse(data);
                                console.log(data);
                            });

                        });
                    }
                    else
                        console.log("Mots de passe différent")
                } else $("#ins_alert_conditions").show('slow');

            });


        });
    </script>

    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js">
    </script>
    <!-- FIN PANNEAU D'AFFICHAGE D'UTILISATION DE COOKIE- -->

</head>

<body>

<nav id="navHeader" class="navbar navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#headNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="./accueil" class="navbar-brand"><img id="logo" src="../assets/img/home.png"/></a>
        </div>
        <div class="collapse navbar-collapse" id="headNavbar">
            <ul class="nav navbar-nav">
                <li>
                    <a href="./recherche?marque=0&largeur=0&serie=0&jante=0&charge=0&categorie=0&vitesse=0&consommation=0&decibel=0">Catalogue
                        de pneus</a>
                </li>
                <li>
                    <a id="searchLink">Recherche</a>
                </li>
                <li><a href="./contact">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right part_connect">
                <li id="btn-connect-account">
                    <a data-placement="bottom" data-toggle="popover" data-title="Connexion" data-container="body"
                       type="button" data-html="true" href="#" id="login">
                        Se connecter <span class="fa fa-user " aria-hidden="true"></span>
                    </a>
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

                        <div id="wrong_id" class="alert-danger alert" role="alert">Mauvais mail ou mot de passe</div>
                        <button type="button" id="seConnecter" class="btn btn-block btn-connect">
                            Se connecter
                            <i class="fa fa-sign-in"></i>
                        </button>
                    </form>


                    <div class="login-footer">
                        <a data-toggle="modal" id="subLink" data-target="#myModal">Pas encore inscrit ?</a>
                        <br>
                        <a id="forgotten" data-toggle="modal" data-target="#modalPasse">Mot de passe oublié ?</a>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="./panier">Panier <span
                            class="fa fa-shopping-cart"
                            aria-hidden="true"></span></a>

                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid searchWell">
        <form action="./recherche" class="form-inline searchForm" role="form" method="get">

            <h3>Filtres de recherche : </h3>

            <div class="row">
                <div class="col-md-3 search-col">
                    <div class="row">
                        <div class="col-md-3 col-sm-7">
                            <label class="control-label" for="sel2">Marque</label>
                        </div>
                        <div class="col-md-3 col-sm-5 pull-left">
                            <select name="marque" class="form-control search-select nav_marque" id="sel2">
                                <option value="0">Toutes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 search-col">
                    <div class="row">
                        <div class="col-md-3 col-sm-7">
                            <label class="control-label" for="sel3">Largeur</label>
                        </div>
                        <div class="col-md-3 col-sm-5 pull-left">
                            <select name="largeur" class="form-control search-select nav_largeur" id="sel3">
                                <option value="0">Toutes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 search-col">
                    <div class="row">
                        <div class="col-md-3 col-sm-7">
                            <label class="control-label" for="sel4">Série</label>
                        </div>
                        <div class="col-md-3 col-sm-5 pull-left">
                            <select name="serie" class="form-control search-select nav_serie" id="sel4">
                                <option value="0">Toutes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 search-col">
                    <div class="row">
                        <div class="col-md-3 col-sm-7">
                            <label class="control-label" for="sel5">Jante</label>
                        </div>
                        <div class="col-md-3 col-sm-5 pull-left">
                            <select name="jante" class="form-control search-select nav_jante" id="sel5">
                                <option value="0">Toutes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 search-col">
                    <div class="row">
                        <div class="col-md-3 col-sm-7">
                            <label class="control-label" for="sel6">Charge</label>
                        </div>
                        <div class="col-md-3 col-sm-5 pull-left">
                            <select name="charge" class="form-control search-select nav_charge" id="sel6">
                                <option value="0">Toutes</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 search-col">
                    <div class="row">
                        <div class="col-md-3 col-sm-7">
                            <label class="control-label" for="sel1">Catégorie</label>
                        </div>
                        <div class="col-md-3 col-sm-5 pull-left">
                            <select name="categorie" class="form-control search-select nav_categorie" id="sel1">
                                <option value="0">Toutes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 search-col">
                    <div class="row">
                        <div class="col-md-3 col-sm-7">
                            <label class="control-label" for="sel7">Vitesse</label>
                        </div>
                        <div class="col-md-3 col-sm-5 pull-left">
                            <select name="vitesse" class="form-control search-select nav_vitesse" id="sel7">
                                <option value="0">Toutes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 search-col">
                    <div class="row">
                        <div class="col-md-3 col-sm-7">
                            <label class="control-label" for="sel8">Conso.</label>
                        </div>
                        <div class="col-md-3 col-sm-5 pull-left">
                            <select name="consommation" class="form-control search-select nav_consommation" id="sel8">
                                <option value="0">Toutes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 search-col">
                    <div class="row">
                        <div class="col-md-3 col-sm-7">
                            <label class="control-label" for="sel9">Decibel</label>
                        </div>
                        <div class="col-md-3 col-sm-5 pull-left">
                            <select name="decibel" class="form-control search-select nav_decibel" id="sel9">
                                <option value="0">Toutes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 search-col pull-right">
                    <button class="btn btn-warning btn-block pull-left" type="submit" value="Rechercher">
                        <i class="fa fa-search fa-fw"></i>Rechercher
                    </button>
                </div>
            </div>

        </form>
    </div>
</nav>

<div class="warper">
    <div class="container main">


