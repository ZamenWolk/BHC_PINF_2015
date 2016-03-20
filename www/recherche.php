<?php
include_once "../secret/credentials.php";
include_once("header.php");
include_once "../assets/php/fonctions/Recherche.php";
//TODO : Quand le doc est pret charger les variables php en js ensuite en Ajax la fonction rechercher pour la page etafficher les résultats
// Refaire les étapes précédentes si on change  les critére ou si on change de page en actualisant les paramètres

?>
    <nav>
        <ul class="pager">
            <li class="previous"><a href="#"><i class="fa fa-arrow-left fa-fw"></i>Page précédente</a></li>
            <li class="next"><a href="#">Page suivante<i class="fa fa-arrow-right fa-fw"></i></a></li>
        </ul>
    </nav>

    <div class="row">
        <div class="well">
            <h1 class="text-center">RECHERCHE</h1>
            <div class="list-group">
                <div class="row" id="articles">
                    <div class="model_article">
                        <div class="col-md-10 list-group-item">
                            <a href="#" id="item-link">
                                <div class="col-md-2">
                                    <img src="../assets/img/pneu.jpg" class="annonce img-responsive"/>
                                </div>
                                <div class="col-md-8 list-group-desc">
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
                        <div class="col-md-2 catalog-cart-div">
                            <label for="qte">Quantité: </label>
                            <select class="form-control" id="qte">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                            <button type="button" class="btn btn-default btn-block pull-right shop-btn"><span
                                    class="fa fa-shopping-cart"
                                    aria-hidden="true"></span> Ajouter au panier
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
    $(document).ready(function(){
        var numero_page=1;
        var categorie= "<?php  echo $_GET['categorie'];?>";
        var marque=  "<?php echo $_GET['marque'];?>";
        var largeur= "<?php echo $_GET['largeur'];?>";
        var serie= "<?php echo $_GET['serie'];?>";
        var jante = "<?php echo $_GET['jante']; ?>";
        var charge= "<?php echo $_GET['charge'];?>";
        var vitesse= "<?php echo $_GET['vitesse'];?>";
        var decibel="<?php echo $_GET['decibel'];?>";
        var consommation = "<?php echo $_GET['consommation'];?>";
        var order= 1;
        var model= $(".model_article");
        var div_articles=$("#articles");
        console.log(consommation);

       /**
        * Chargement des pneus la première fois que l'on charge la page
        * */

        $.post(
            "../assets/php/ajax/recherche.php",
            {
                action: "chargement",
                categorie: categorie,
                marque: marque,
                largeur: largeur,
                serie: serie,
                jante: jante,
                charge: charge,
                vitesse: vitesse,
                decibel: decibel,
                consommation: consommation,
                numeroPage: numero_page,
                itemParPage: 10,
                order: order
            },
            function (data){
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

                            div_articles.append(jQ);
                        }
                        model.hide();
                    }
                    else {
                        model.hide();
                        div_articles.html("<h2 style='color:white' >Nous somme désolé mais il n'y a aucun pneus correspondant à vos critères de recherches.</h2>");
                    }
                }

                var pagination = $(".paginat");

            //gestion de l'affichage de la pagination
            if(data["nbrResult"] < 25 &&  numero_page == 1)
            {
                pagination.hide();
            }
            else
            {
                pagination.show();
            }


            /* Gestion des boutons suivant et précédent*/
            var prev = $(".previous");
            var activePrev =false;
            var suiv = $(".next");
            var activeNext =true;
            prev.addClass("disabled");

                /**
                 * Gestion du chargement de la page précédente
                 */

                prev.click(function(){
                if(activePrev){
                    numero_page--;
                    $.post(
                        "../assets/php/ajax/recherche.php",
                        {
                            action: "chargement",
                            categorie: categorie,
                            marque: marque,
                            largeur: largeur,
                            serie: serie,
                            jante: jante,
                            charge: charge,
                            vitesse: vitesse,
                            decibel: decibel,
                            consommation: consommation,
                            numeroPage: numero_page,
                            itemParPage: 10,
                            order: order
                        },
                        function (data) {
                            data = JSON.parse(data);
                            if (numero_page == 1) {
                                prev.addClass("disabled");
                                activePrev = false;
                            }
                            if (data["nbrResult"] == data["resultat"][0]["itemParPage"]) {
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
                /**
                 * Gestion du chargement de la page suivante
                 */
            suiv.click(function(){
                if(activeNext) {
                    numero_page++;
                    activePrev = true;
                    $.post(
                        "../assets/php/ajax/recherche.php",
                        {
                            action: "chargement",
                            categorie: categorie,
                            marque: marque,
                            largeur: largeur,
                            serie: serie,
                            jante: jante,
                            charge: charge,
                            vitesse: vitesse,
                            decibel: decibel,
                            consommation: consommation,
                            numeroPage: numero_page,
                            itemParPage: 10,
                            order: order
                        },
                        function (data) {
                            data = JSON.parse(data);
                            if (numero_page > 1) {
                                prev.removeClass("disabled");
                                activePrev = true;
                            }
                            if (data["nbrResult"] < data["resultat"][0]["itemParPage"]) {
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