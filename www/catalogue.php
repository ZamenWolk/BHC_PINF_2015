<?php
include_once "../secret/credentials.php";
include_once("header.php");
include_once "../assets/php/fonctions/Recherche.php";
//TODO : Quand le doc est pret charger les variables php en js ensuite en Ajax la fonction rechercher pour la page etafficher les résultats
// Refaire les étapes précédentes si on change  les critére ou si on change de page en actualisant les paramètres


?>
    <nav>
        <ul class="pager">
            <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Page précédente</a></li>
            <li class="next"><a href="#">Page suivante <span aria-hidden="true">&rarr;</span></a></li>
        </ul>
    </nav>

    <div class="row">
        <div class="well">
            <h1 class="text-center">CATALOGUE</h1>
            <div class="list-group">
                <div class="row" id="articles">


                    <div class="model_article">
                        <div class="col-lg-10 list-group-item">
                            <a href="#" id="item-link">
                                <div class="col-md-3">
                                    <img src="../assets/img/pneu.jpg" class="annonce img-responsive"/>
                                </div>
                                <div class="col-md-7 list-group-desc">
                                    <h4 class="list-group-item-heading"></h4>
                                    <dl class="dl-horizontal">
                                        <dt>Catégorie:</dt>
                                        <dd class="categorie"></dd>
                                        <dt>Largeur:</dt>
                                        <dd class="largeur"></dd>
                                        <dt>Série:</dt>
                                        <dd class="serie"></dd>
                                        <dt>Jante:</dt>
                                        <dd class="jante"></dd>
                                    </dl>
                                </div>
                                <div class="col-md-2 text-center price-div">
                                    <h4 id="price">Prix:</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-default btn-block btn-lg pull-right shop-btn"><span
                                    class="fa fa-shopping-cart"
                                    aria-hidden="true"></span> Ajouter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav>
        <ul class="pager">
            <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Page précédente</a></li>
            <li class="next"><a href="#">Page suivante <span aria-hidden="true">&rarr;</span></a></li>
        </ul>
    </nav>

    <script>
        $(document).ready(function () {
            var numero_page = 1;
            var model = $(".model_article");
            var div_articles = $("#articles");
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
                    order: 10
                },
                function (data) {
                    data = JSON.parse(data);

                    console.log(data);
                    if (data["etat"] == "reussite") {
                        if (data["nbrResult"] > 0) {
                            $("#item-link").attr("href", "./produit?ref=" + data["resultat"][0]["pneu_ref"]);
                            for (var i = 0; i < data["nbrResult"]; i++) {
                                var pneu_marque = data["resultat"][i]["pneu_marque"];
                                var pneu_categorie = data["resultat"][i]["pneu_categorie"];
                                var pneu_largeur = data["resultat"][i]["pneu_largeur"];
                                var pneu_serie = data["resultat"][i]["pneu_serie"];
                                var pneu_jante = data["resultat"][i]["pneu_jante"];
                                var pneu_charge = data["resultat"][i]["pneu_charge"];
                                var pneu_vitesse = data["resultat"][i]["pneu_vitesse"];
                                var pneu_description = data["resultat"][i]["pneu_description"];
                                var pneu_prix = data["resultat"][i]["pneu_prix"];// Attention peut être à changer pour tenir compte du multplicateur
                                //console.log(marque);
                                //console.log("Je boucle" + i);
                                var pneu_ref = data["resultat"][i]["pneu_ref"];
                                var jQ = model.clone();
                                jQ.show();
                                $("#item-link").attr("href", "./produit?ref=" + pneu_ref);
                                var list = jQ.children(".list-group-item");
                                var item = list.children("a");
                                jQ.removeClass("model_article");
                                var listBody = item.children(".list-group-desc");
                                listBody.children(".list-group-item-heading").html("<a href=\"./produit?ref=" + pneu_ref + "\"><b>" + pneu_description + "</b></a>");
                                //console.log(panelBody);
                                var dl_specs = listBody.children("dl");
                                dl_specs.children(".largeur").html(pneu_largeur);
                                dl_specs.children(".categorie").html(pneu_categorie);
                                dl_specs.children(".serie").html(pneu_serie);
                                dl_specs.children(".jante").html(pneu_jante);

                                var priceDiv = item.children(".price-div");
                                priceDiv.children("#price").html("Prix : " + pneu_prix + " € ");

                                div_articles.append(jQ);
                            }
                            model.hide();
                        }
                        else {
                            model.hide();
                            div_articles.html("<h2 style='color:white' >Nous somme désolé mais il n'y a aucun pneus correspondant à vos critères de recherches.</h2>");
                        }
                    }


                    /* Gestion des boutons suivant et précédent*/
                    var prev = $(".previous");
                    var activePrev = false;
                    var suiv = $(".next");
                    var activeNext = true;
                    prev.addClass("disabled");

                    prev.click(function () {
                        if (activePrev) {
                            numero_page--;
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
                                    order: 10
                                },
                                function (data) {
                                    data = JSON.parse(data);
                                    if (numero_page == 1) {
                                        prev.addClass("disabled");
                                        activePrev = false;
                                    }
                                    if (data["nbrResult"] == 25) {
                                        suiv.removeClass("disabled");
                                        activeNext = true;
                                    }
                                    div_articles.html("");
                                    if (data["etat"] == "reussite") {
                                        if (data["nbrResult"] > 0) {
                                            for (var i = 0; i < data["nbrResult"]; i++) {
                                                var pneu_marque = data["resultat"][i]["pneu_marque"];
                                                var pneu_categorie = data["resultat"][i]["pneu_categorie"];
                                                var pneu_largeur = data["resultat"][i]["pneu_largeur"];
                                                var pneu_serie = data["resultat"][i]["pneu_serie"];
                                                var pneu_jante = data["resultat"][i]["pneu_jante"];
                                                var pneu_charge = data["resultat"][i]["pneu_charge"];
                                                var pneu_vitesse = data["resultat"][i]["pneu_vitesse"];
                                                var pneu_description = data["resultat"][i]["pneu_description"];
                                                var pneu_prix = data["resultat"][i]["pneu_prix"];// Attention peut être à changer pour tenir compte du multplicateur
                                                //console.log(marque);
                                                //console.log("Je boucle" + i);
                                                var pneu_ref = data["resultat"][i]["pneu_ref"];
                                                var jQ = model.clone();
                                                $("#item-link").attr("href", "./produit?ref=" + pneu_ref);
                                                var list = jQ.children(".list-group-item");
                                                var item = list.children("a");
                                                jQ.removeClass("model_article");
                                                jQ.show();
                                                var listBody = item.children(".list-group-desc");
                                                listBody.children(".list-group-item-heading").html("<a href=\"./produit?ref=" + pneu_ref + "\"><b>" + pneu_description + "</b></a>");
                                                //console.log(panelBody);
                                                var dl_specs = listBody.children("dl");
                                                dl_specs.children(".largeur").html(pneu_largeur);
                                                dl_specs.children(".categorie").html(pneu_categorie);
                                                dl_specs.children(".serie").html(pneu_serie);
                                                dl_specs.children(".jante").html(pneu_jante);

                                                var priceDiv = item.children(".price-div");
                                                priceDiv.children("#price").html("Prix : " + pneu_prix + " € ");

                                                div_articles.append(jQ)
                                            }
                                            model.hide();
                                        }
                                        else {
                                            model.hide();
                                            div_articles.html("<h2 style='color:white' >Nous somme désolé mais il n'y a aucun pneus correspondant à vos critères de recherches.</h2>");
                                        }
                                    }

                                });
                        }
                    });
                    suiv.click(function () {
                        if (activeNext) {
                            numero_page++;
                            activePrev = true;
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
                                    order: 10
                                },
                                function (data) {
                                    data = JSON.parse(data);
                                    if (numero_page > 1) {
                                        prev.removeClass("disabled");
                                        activePrev = true;
                                    }
                                    if (data["nbrResult"] < 25) {
                                        suiv.addClass("disabled");
                                        activeNext = false;
                                    }
                                    div_articles.html("");
                                    if (data["etat"] == "reussite") {
                                        if (data["nbrResult"] > 0) {
                                            for (var i = 0; i < data["nbrResult"]; i++) {
                                                var pneu_marque = data["resultat"][i]["pneu_marque"];
                                                var pneu_categorie = data["resultat"][i]["pneu_categorie"];
                                                var pneu_largeur = data["resultat"][i]["pneu_largeur"];
                                                var pneu_serie = data["resultat"][i]["pneu_serie"];
                                                var pneu_jante = data["resultat"][i]["pneu_jante"];
                                                var pneu_charge = data["resultat"][i]["pneu_charge"];
                                                var pneu_vitesse = data["resultat"][i]["pneu_vitesse"];
                                                var pneu_description = data["resultat"][i]["pneu_description"];
                                                var pneu_prix = data["resultat"][i]["pneu_prix"];// Attention peut être à changer pour tenir compte du multplicateur
                                                //console.log(marque);
                                                //console.log("Je boucle" + i);
                                                var pneu_ref = data["resultat"][i]["pneu_ref"];
                                                var jQ = model.clone();
                                                $("#item-link").attr("href", "./produit?ref=" + pneu_ref);
                                                var list = jQ.children(".list-group-item");
                                                var item = list.children("a");
                                                jQ.removeClass("model_article");
                                                var listBody = item.children(".list-group-desc");
                                                listBody.children(".list-group-item-heading").html("<a href=\"./produit?ref=" + pneu_ref + "\"><b>" + pneu_description + "</b></a>");
                                                //console.log(panelBody);
                                                jQ.show();
                                                var dl_specs = listBody.children("dl");
                                                dl_specs.children(".largeur").html(pneu_largeur);
                                                dl_specs.children(".categorie").html(pneu_categorie);
                                                dl_specs.children(".serie").html(pneu_serie);
                                                dl_specs.children(".jante").html(pneu_jante);

                                                var priceDiv = item.children(".price-div");
                                                priceDiv.children("#price").html("Prix : " + pneu_prix + " € ");

                                                div_articles.append(jQ)
                                            }
                                            model.hide();
                                        }
                                        else {
                                            model.hide();
                                            div_articles.html("<h2 style='color:white' >Nous somme désolé mais il n'y a aucun pneus correspondant à vos critères de recherches.</h2>");
                                        }
                                    }

                                });
                        }
                    });


                });
        });
    </script>

<?php
include_once("footer.php");
?>