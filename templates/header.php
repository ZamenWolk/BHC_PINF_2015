<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JS Pneus</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css"/>
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <script src="assets/bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <link rel="stylesheet" href="assets/bootstrap/flat-ui.css">
    <script src="assets/js/star.js"></script>
    <script src="assets/js/script.js"></script>
    <link href="assets/css/checkbox.css" rel="stylesheet">
    <style>

        .btn-search {
            background:none;
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
		window.cookieconsent_options = {"message":"Ce site contient des cookies qui sont utilisés dans le but d'améliorer votre expérience de navigation.","dismiss":"D'accord","learnMore":"Plus d'informations","link":null,"theme":"dark-bottom"};
		//Le "Link" peut être changé pour un lien de police d'utilisation des cookies à générer ou à faire soi même
		//Le thème est changeable en fonction de la disposition ou de la couleur.
		</script>

		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
		<!-- FIN PANNEAU D'AFFICHAGE D'UTILISATION DE COOKIE- -->

</head>

<body>
<div class="container">
    <br>

    <div class="row">
        <div class="col-md-8 ">
            <img id="logo" src="assets/img/logo.svg"/>
        </div>
        <form class="form-inline" action="interpretation.php" method="post">
            <div class="input-group">
                <input class="form-control" id="search" name="search" placeholder="Rechercher ..." style="border-right-style:none; "><!-- Zone de texte où entrer les mots clés -->
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-search" name="recherche"
                                    value="true"><span class="glyphicon glyphicon-search"
                                                       aria-hidden="true"></span></button><!-- Bouton rechercher -->
                </span>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="navbar navbar-default navbar-static-top">
            <ul class="nav navbar-nav">
                <li><a href="?url=accueil">Accueil</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catalogue de pneus<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Catégorie 1</a></li>
                        <li><a href="#">Catégorie 2</a></li>
                        <li><a href="#">Catégorie 3</a></li>
                    </ul>
                </li>
                <li><a href="#">C.G.V</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="">Panier<span class="glyphicon glyphicon-shopping-cart"
                                           aria-hidden="true"></span></button></a>
                    <ul class="dropdown-menu" role="menu" style="width:200%;">
                        <li><a href="#">Article 1</a></li>
                        <li><a href="#">Article 2</a></li>
                        <li><a href="#">Article 3</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Prix total : 999 €</li>
                    </ul>
                </li>
                <li><a href=""><?php
                        /* Verifie si la personne est connécter et change le bouton en fonction */
                        if (isset($_SESSION['connecter'])) echo "Mon compte"; else echo "Se connecter"; ?>  <span
                            class="glyphicon glyphicon-user " aria-hidden="true"></span></a></li>
            </ul>
        </div>
    </div>





