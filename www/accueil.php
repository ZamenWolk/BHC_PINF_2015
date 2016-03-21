<?php
include_once("header.php");
?>


<!-- Indicators -->
<div id="mainCar" class="main-car carousel slide" data-ride="carousel">
    <ol class="main-car carousel-indicators">
        <li data-target="#mainCar" data-slide-to="0" class="active"></li>
        <li data-target="#mainCar" data-slide-to="1"></li>
        <li data-target="#mainCar" data-slide-to="2"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="main-car carousel-inner" role="listbox">
        <div class="item active">
            <img src="../assets/img/car1.jpg" class="car-img img-responsive">
            <div class="main-car carousel-caption">
                <h2>Bienvenue sur JS Pneus !</h2>
                <p>Site de vente de pneus pour auto et moto</p>
            </div>
        </div>
        <div class="item">
            <img src="../assets/img/car2.jpg" class="car-img img-responsive">
            <div class="main-car carousel-caption">
                <h2>Un vaste choix de pneus</h2>
                <p>Choisissez les pneus qu'il vous faut parmi une grande sélection de marques</p>
            </div>
        </div>
        <div class="item">
            <img src="../assets/img/car3.jpg" class="car-img img-responsive">
            <div class="main-car carousel-caption">
                <h2>Les prix les plus bas</h2>
                <p>Des prix défiant toute concurrence !</p>
            </div>
        </div>
    </div>
    <!-- Left and right controls -->

    <a id="main-car" class="main-car left carousel-control" href="#mainCar" role="button" data-slide="prev">
        <span class="fa fa-angle-left fa-3x" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a id="main-car" class="main-car right carousel-control" href="#mainCar" role="button" data-slide="next">
        <span class="fa fa-angle-right fa-3x" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div>
<hr>
<div class="row">

    <div class="col-lg-4 img-col" id="home1">
        <div class="hovereffect">
            <a href="#">
                <img class="img-responsive" src="../assets/img/home1.png">
                <div class="overlay">
                    <h2>Catalogue</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 img-col" id="home2">
        <div class="hovereffect">
            <a href="#">
                <img class="img-responsive" src="../assets/img/home2.png">
                <div class="overlay">
                    <h2>F.A.Q.</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 img-col" id="home3">
        <div class="hovereffect">
            <a href="#">
                <img class="img-responsive" src="../assets/img/home3.png">
                <div class="overlay">
                    <h2>Contact</h2>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="prodCar" class="prod carousel slide">

            <ol class="prod carousel-indicators">
                <li data-target="#prodCar" data-slide-to="0" class="active"></li>
                <li data-target="#prodCar" data-slide-to="1"></li>
                <li data-target="#prodCar" data-slide-to="2"></li>
            </ol>

            <!-- Carousel items -->
            <div class="prod carousel-inner">
                <div class="prod item active">
                    <div class="row" id="home-articles">
                        <div class="col-md-3 modele">
                            <a href="#" class="thumbnail">
                                <img src="http://placehold.it/250x250" alt="Image" style="max-width:100%;">
                                <div class="caption">
                                    <h5></h5>
                                    <p>Prix: </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <a data-slide="prev" href="#prodCar" class="prod left carousel-control">
                <span class="fa fa-angle-left fa-3x" aria-hidden="true"></span>
                <span class="sr-only previous">Previous</span></a>
            <a data-slide="next" href="#prodCar" class="prod right carousel-control">
                <span class="fa fa-angle-right fa-3x" aria-hidden="true"></span>
                <span class="sr-only next">Next</span></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h3>Pneus par type de véhicule</h3>
        <ul>
            <li><img src="../assets/img/tourisme.png"><a href="#">Tourisme</a></li>
            <li><img src="../assets/img/4x4.png"><a href="#">4X4</a></li>
            <li><img src="../assets/img/utilitaire.png"><a href="#">Utilitaire</a></li>
        </ul>
    </div>
    <div class="col-md-6">
        <h3>Pneus par saison</h3>
        <ul>
            <li style="padding-top: 8px"><img src="../assets/img/hiver.png"><a href="#">Hiver</a></li>
            <li style="padding-top: 8px"><img src="../assets/img/été.png"><a href="#">&Eacute;té</a></li>
            <li style="padding-top: 8px"><img src="../assets/img/4saisons.png"><a href="#">Toutes saisons</a></li>
        </ul>
    </div>
</div>
<div class="push"></div>

<script>
    $(document).ready(function () {
        var numero_page = 1;
        var model = $(".modele");
        var div_articles = $("#home-articles");
        $.post(
            "../assets/php/ajax/recherche.php",
            {
                action: "chargement",
                categorie: 0,
                marque: 0,
                largeur: 0,
                serie: 0,
                jante: 0,
                charge: 0,
                vitesse: 0,
                consommation: 0,
                decibel: 0,
                numeroPage: numero_page,
                itempParPage: 4,
                order: 10
            },
            function (data) {
                data = JSON.parse(data);

                console.log(data);
                if (data["etat"] == "reussite") {
                    if (data["nbrResult"] > 0) {
                        for (var i = 0; i < data["nbrResult"]; i++) {
                            var pneu_description = data["resultat"][i]["pneu_description"];
                            var pneu_prix = data["resultat"][i]["pneu_prix"];// Attention peut être à changer pour tenir compte du multplicateur
                            var jQ = model.clone();
                            jQ.show();
                            var link = jQ.children(".thumbnail");
                            var caption = link.children(".caption");
                            jQ.removeClass("modele");
                            $(".thumbnail").attr("href", "./produit?ref=" + data["resultat"][i]["pneu_ref"]);
                            caption.children("h5").html(pneu_description);
                            caption.children("p").html("Prix : " + pneu_prix + " € ");
                            div_articles.append(jQ);
                        }
                        model.hide();
                    }
                    else {
                        model.hide();
                    }
                }
            });
    });

</script>


<?php
include_once("footer.php");
?>
