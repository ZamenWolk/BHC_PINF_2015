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
            <img src="assets/img/logo-car.jpg" class="car-img img-responsive">
            <div class="main-car carousel-caption">
                <h2>Bienvenue sur JS Pneus !</h2>
                <p>Site de vente de pneus pour autos, motos et 4x4</p>
            </div>
        </div>
        <div class="item">
            <img src="assets/img/distrib_achilles.jpg" class="car-img img-responsive">
            <div class="main-car carousel-caption">
                <h2>Marque Achilles</h2>
                <p>La gamme complète disponible</p>
            </div>
        </div>
        <div class="item">
            <img src="assets/img/car2.jpg" class="car-img img-responsive">
            <div class="main-car carousel-caption">
                <h2>Un vaste choix de pneus</h2>
                <p>Vous cherchez un pneu précis ? Nous l'avons !</p>
            </div>
        </div>
        <div class="item">
            <img src="assets/img/marques.jpg" class="car-img img-responsive">
            <div class="main-car carousel-caption">
                <h2>Des tonnes de marques !</h2>
                <p>Notre catalogue contient toutes les grandes marques de pneus</p>
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
            <a href="./recherche?marque=0&largeur=0&serie=0&jante=0&charge=0&categorie=0&vitesse=0&consommation=0&decibel=0">
                <img class="img-responsive" src="assets/img/home1.jpg">
                <div class="overlay">
                    <h2>Catalogue</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 img-col" id="home2">
        <div class="hovereffect">
            <a href="./faq">
                <img class="img-responsive" src="assets/img/home2.jpg">
                <div class="overlay">
                    <h2>F.A.Q.</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 img-col" id="home3">
        <div class="hovereffect">
            <a href="./contact">
                <img class="img-responsive" src="assets/img/home3.jpg">
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
                                <img src="" alt="Pas d'image disponible" style="max-width:100%;">
                                <div class="caption">
                                    <h5></h5>
                                    <p>Prix: </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="prod item">
                    <div class="row" id="home-articles22">
                    </div>
                </div>

                <div class="prod item">
                    <div class="row" id="home-articles33">
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
            <li>
                <a href="./recherche?marque=0&largeur=0&serie=0&jante=0&charge=0&categorie=Tourisme+Toutes+Saisons&vitesse=0&consommation=0&decibel=0">
                    <img src="assets/img/tourisme.png">Tourisme</a></li>
            <li>
                <a href="./recherche?marque=0&largeur=0&serie=0&jante=0&charge=0&categorie=4X4+Toutes+Saisons&vitesse=0&consommation=0&decibel=0">
                    <img src="assets/img/4x4.png">4X4</a></li>
            <li>
                <a href="./recherche?marque=0&largeur=0&serie=0&jante=0&charge=0&categorie=Utilitaire+Toutes+Saisons&vitesse=0&consommation=0&decibel=0">
                    <img src="assets/img/utilitaire.png">Utilitaire</a></li>
        </ul>
    </div>
    <div class="col-md-6">
        <h3>Pneus par saison</h3>
        <ul>
            <li style="padding-top: 8px">
                <a href="./recherche?marque=0&largeur=0&serie=0&jante=0&charge=0&categorie=Tourisme+Ete&vitesse=0&consommation=0&decibel=0">
                    <img src="assets/img/hiver.png">Hiver</a></li>
            <li style="padding-top: 8px">
                <a href="./recherche?marque=0&largeur=0&serie=0&jante=0&charge=0&categorie=Tourisme+Ete&vitesse=0&consommation=0&decibel=0">
                    <img src="assets/img/été.png">&Eacute;té</a></li>
            <li style="padding-top: 8px">
                <a href="./recherche?marque=0&largeur=0&serie=0&jante=0&charge=0&categorie=0&vitesse=0&consommation=0&decibel=0">
                    <img src="assets/img/4saisons.png">Toutes saisons</a></li>
        </ul>
    </div>
</div>
<div class="push"></div>

<script>
    $(document).ready(function () {
        var numero_page = 1;
        var model = $(".modele");
        var div_articles = $("div#home-articles");
        var div_articles2 =$("div#home-articles22");
        var div_articles3 =$("div#home-articles33");
        console.log(div_articles2);console.log(div_articles3);


        $.post(
            "assets/php/ajax/recherche.php",
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
                itemParPage: 12,
                order: 10
            },
            function (data) {
                data = JSON.parse(data);
                var i;
                console.log(data);
                if (data["etat"] == "reussite") {
                    if (data["nbrResult"] > 0) {
                        for (i = 0; i < data["nbrResult"]; i++) {
                            var jQ = model.clone();
                            if(i < 4)
                                div_articles.append(jQ);
                            if(i<8 && i > 3)
                                div_articles2.append(jQ);
                            if(i>7)
                                div_articles3.append(jQ);
                            var pneu_description = data["resultat"][i]["pneu"]["pneu_description"];
                            var pneu_prix = data["resultat"][i]["prix"];// Attention peut être à changer pour tenir compte du multplicateur

                            jQ.show();
                            var link = jQ.children(".thumbnail");
                            var caption = link.children(".caption");
                            jQ.removeClass("modele");

                            link.attr("href", "./produit?ref=" + data["resultat"][i]["pneu"]["pneu_ref"]);
                            link.children("img").attr("src","assets/img/logo/" + data["resultat"][i]["pneu"]["pneu_marque"].toLowerCase() +".png");
                            caption.children("h5").html(pneu_description);
                            caption.children("p").html("Prix : " + pneu_prix + " € ");

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
