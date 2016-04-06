<?php
include_once "../secret/credentials.php";
include_once("header.php");
//include_once "../assets/php/fonctions/Recherche.php";
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
            <label for="order">Tri par prix :</label>
            <select class="form-control" id="order">
                <option value="1">
                    Croissant
                </option>
                <option value="2">
                    Décroissant
                </option>
            </select>
            <div class="list-group">
                <div class="row" id="articles">
                    <div class="model_article">
                        <div class="col-md-10 list-group-item">
                            <a href="#" id="item-link">
                                <div class="col-md-2 logo-img">
                                    <img src="" alt="Pas d'image disponible" class="annonce img-responsive"/>
                                </div>
                                <div class="col-md-8 list-group-desc">
                                    <h4 class="list-group-item-heading"></h4>
                                    <dl class="col-md-3 dl-horizontal">
                                        <dt>Catégorie:</dt>
                                        <dd class="categorie"></dd>
                                        <dt>Largeur:</dt>
                                        <dd class="largeur"></dd>
                                        <dt>Série:</dt>
                                        <dd class="serie"></dd>
                                        <dt>Jante:</dt>
                                        <dd class="jante"></dd>
                                    </dl>
                                    <dl class="col-md-3 col-md-offset-2 dl-horizontal">
                                        <dt>Charge:</dt>
                                        <dd class="charge"></dd>
                                        <dt>Vitesse:</dt>
                                        <dd class="vitesse"></dd>
                                        <dt>Conso:</dt>
                                        <dd class="consommation"></dd>
                                        <dt>Décibels:</dt>
                                        <dd class="decibel"></dd>
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
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
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
        $(document).ready(function () {
            var numero_page = 1;
            var categorie = "<?php  echo $_GET['categorie'];?>";
            var marque = "<?php echo $_GET['marque'];?>";
            var largeur = "<?php echo $_GET['largeur'];?>";
            var serie = "<?php echo $_GET['serie'];?>";
            var jante = "<?php echo $_GET['jante']; ?>";
            var charge = "<?php echo $_GET['charge'];?>";
            var vitesse = "<?php echo $_GET['vitesse'];?>";
            var decibel = "<?php echo $_GET['decibel'];?>";
            var consommation = "<?php echo $_GET['consommation'];?>";
            var order = 1;
            var model = $(".model_article");
            var div_articles = $("#articles");
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
                function (data) {
                    data = JSON.parse(data);

                    console.log(data);
                    if (data["etat"] == "reussite") {
                        if (data["nbrResult"] > 0) {
                            $("#item-link").attr("href", "./produit?ref=" + data["resultat"][0]["pneu"]["pneu_ref"]);
                            for (var i = 0; i < data["nbrResult"]; i++) {
                                var pneu_marque = data["resultat"][i]["pneu"]["pneu_marque"];
                                var pneu_categorie = data["resultat"][i]["pneu"]["pneu_categorie"];
                                var pneu_largeur = data["resultat"][i]["pneu"]["pneu_largeur"];
                                var pneu_serie = data["resultat"][i]["pneu"]["pneu_serie"];
                                var pneu_jante = data["resultat"][i]["pneu"]["pneu_jante"];
                                var pneu_charge = data["resultat"][i]["pneu"]["pneu_charge"];
                                var pneu_stock = data["resultat"][i]["pneu"]["pneu_stock"];
                                var pneu_vitesse = data["resultat"][i]["pneu"]["pneu_vitesse"];
                                var pneu_consommation = data["resultat"][i]["pneu"]["pneu_consommation"];
                                var pneu_decibel = data["resultat"][i]["pneu"]["pneu_decibel"];
                                var pneu_description = data["resultat"][i]["pneu"]["pneu_description"];
                                var pneu_prix = data["resultat"][i]["prix"];// Attention peut être à changer pour tenir compte du multplicateur

                                var pneu_ref = data["resultat"][i]["pneu"]["pneu_ref"];
                                var jQ = model.clone();
                                jQ.addClass('resultPneu');
                                var list = jQ.children(".list-group-item");
                                var panel = jQ.children(".catalog-cart-div");
                                var shop_btn = panel.children(".shop-btn");
                                var shop_qtt = panel.children("#qte");
                                var label = panel.children("label");
                                label.attr("for", "qte" + pneu_ref);
                                shop_qtt.attr('id', 'qte' + pneu_ref);
                                shop_btn.val(pneu_ref);
                                var item = list.children("a");
                                var imgDiv = item.children(".logo-img");
                                jQ.removeClass("model_article");
                                var listBody = item.children(".list-group-desc");
                                item.attr("href", "./produit?ref=" + data["resultat"][i]["pneu"]["pneu_ref"]);
                                listBody.children(".list-group-item-heading").html("<b>" + pneu_description + "</b>");
                                //console.log(panelBody);
                                jQ.show();
                                imgDiv.children("img").attr("src", "../assets/img/logo/" + data["resultat"][i]["pneu"]["pneu_marque"] + ".png");
                                var dl_specs = listBody.children("dl");
                                dl_specs.children(".largeur").html(pneu_largeur);
                                dl_specs.children(".categorie").html(pneu_categorie);
                                dl_specs.children(".serie").html(pneu_serie);
                                dl_specs.children(".jante").html(pneu_jante);
                                dl_specs.children(".consommation").html(pneu_consommation);
                                dl_specs.children(".decibel").html(pneu_decibel);
                                dl_specs.children(".charge").html(pneu_charge);
                                dl_specs.children(".vitesse").html(pneu_vitesse);

                                var priceDiv = item.children(".price-div");
                                priceDiv.children("#price").html("Prix : " + pneu_prix + " € ");

                                div_articles.append(jQ);
                            }
                            model.hide();
                        }
                        else {
                            model.hide();
                            div_articles.html("<h2>Nous somme désolé mais il n'y a aucun pneu correspondant à vos critères de recherches.</h2>");
                        }
                    }

                    $("#order").change(function(){
                        order = $("#order option:selected").val();
                        console.log(order);
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
                                div_articles.html("");
                                console.log(data);
                                if (data["etat"] == "reussite") {
                                    if (data["nbrResult"] > 0) {
                                        $("#item-link").attr("href", "./produit?ref=" + data["resultat"][0]["pneu"]["pneu_ref"]);
                                        for (var i = 0; i < data["nbrResult"]; i++) {
                                            var pneu_marque = data["resultat"][i]["pneu"]["pneu_marque"];
                                            var pneu_categorie = data["resultat"][i]["pneu"]["pneu_categorie"];
                                            var pneu_largeur = data["resultat"][i]["pneu"]["pneu_largeur"];
                                            var pneu_serie = data["resultat"][i]["pneu"]["pneu_serie"];
                                            var pneu_jante = data["resultat"][i]["pneu"]["pneu_jante"];
                                            var pneu_charge = data["resultat"][i]["pneu"]["pneu_charge"];
                                            var pneu_stock = data["resultat"][i]["pneu"]["pneu_stock"];
                                            var pneu_vitesse = data["resultat"][i]["pneu"]["pneu_vitesse"];
                                            var pneu_consommation = data["resultat"][i]["pneu"]["pneu_consommation"];
                                            var pneu_decibel = data["resultat"][i]["pneu"]["pneu_decibel"];
                                            var pneu_description = data["resultat"][i]["pneu"]["pneu_description"];
                                            var pneu_prix = data["resultat"][i]["prix"];// Attention peut être à changer pour tenir compte du multplicateur

                                            var pneu_ref = data["resultat"][i]["pneu"]["pneu_ref"];
                                            var jQ = model.clone();
                                            jQ.addClass('resultPneu');
                                            var list = jQ.children(".list-group-item");
                                            var panel = jQ.children(".catalog-cart-div");
                                            var shop_btn = panel.children(".shop-btn");
                                            var shop_qtt = panel.children("#qte");
                                            var label = panel.children("label");
                                            label.attr("for", "qte" + pneu_ref);
                                            shop_qtt.attr('id', 'qte' + pneu_ref);
                                            shop_btn.val(pneu_ref);
                                            var item = list.children("a");
                                            var imgDiv = item.children(".logo-img");
                                            jQ.removeClass("model_article");
                                            var listBody = item.children(".list-group-desc");
                                            item.attr("href", "./produit?ref=" + data["resultat"][i]["pneu"]["pneu_ref"]);
                                            listBody.children(".list-group-item-heading").html("<b>" + pneu_description + "</b>");
                                            //console.log(panelBody);
                                            jQ.show();
                                            imgDiv.children("img").attr("src", "../assets/img/logo/" + data["resultat"][i]["pneu"]["pneu_marque"] + ".png");
                                            var dl_specs = listBody.children("dl");
                                            dl_specs.children(".largeur").html(pneu_largeur);
                                            dl_specs.children(".categorie").html(pneu_categorie);
                                            dl_specs.children(".serie").html(pneu_serie);
                                            dl_specs.children(".jante").html(pneu_jante);
                                            dl_specs.children(".consommation").html(pneu_consommation);
                                            dl_specs.children(".decibel").html(pneu_decibel);
                                            dl_specs.children(".charge").html(pneu_charge);
                                            dl_specs.children(".vitesse").html(pneu_vitesse);

                                            var priceDiv = item.children(".price-div");
                                            priceDiv.children("#price").html("Prix : " + pneu_prix + " € ");

                                            div_articles.append(jQ);
                                        }
                                        model.hide();
                                    }
                                    else {
                                        model.hide();
                                        div_articles.html("<h2>Nous somme désolé mais il n'y a aucun pneu correspondant à vos critères de recherches.</h2>");
                                    }
                                }
                            });
                        //TODO : Il faut faire la fonction $.post
                    });

                    var pagination = $(".paginat");

                    //gestion de l'affichage de la pagination
                    if (data["nbrResult"] < 25 && numero_page == 1) {
                        pagination.hide();
                    }
                    else {
                        pagination.show();
                    }


                    /* Gestion des boutons suivant et précédent*/
                    var prev = $(".previous").addClass("disabled");
                    var activePrev = false;
                    var suiv = $(".next");
                    var activeNext;
                    if(data["nbrResult"] == data["resultat"][0]["itemParPage"])
                        activeNext = true;
                    else
                        activeNext = true;
                    prev.addClass("disabled");

                    /**
                     * Gestion du chargement de la page précédente
                     */

                    prev.click(function () {
                        if (activePrev) {
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
                                    if (data["nbrResult"] == data["resultat"][0]["itemParPage"]) { //TODO Il n'existe pas de variable "itemParPage" dans le JSON renvoyé par l'AJAX ! /!\
                                        suiv.removeClass("disabled");
                                        activeNext = true;
                                    }
                                    div_articles.html("");
                                    if (data["etat"] == "reussite") {
                                        if (data["nbrResult"] > 0) {
                                            for (var i = 0; i < data["nbrResult"]; i++) {
                                                var pneu_marque = data["resultat"][i]["pneu"]["pneu_marque"];
                                                var pneu_categorie = data["resultat"][i]["pneu"]["pneu_categorie"];
                                                var pneu_largeur = data["resultat"][i]["pneu"]["pneu_largeur"];
                                                var pneu_serie = data["resultat"][i]["pneu"]["pneu_serie"];
                                                var pneu_jante = data["resultat"][i]["pneu"]["pneu_jante"];
                                                var pneu_charge = data["resultat"][i]["pneu"]["pneu_charge"];
                                                var pneu_vitesse = data["resultat"][i]["pneu"]["pneu_vitesse"];
                                                var pneu_stock = data["resultat"][i]["pneu"]["pneu_stock"];
                                                console.log(pneu_stock);
                                                var pneu_description = data["resultat"][i]["pneu"]["pneu_description"];
                                                var pneu_prix = data["resultat"][i]["prix"];// Attention peut être à changer pour tenir compte du multplicateur
                                                var pneu_ref = data["resultat"][i]["pneu"]["pneu_ref"];
                                                var jQ = model.clone();
                                                jQ.addClass('resultPneu');
                                                var list = jQ.children(".list-group-item");
                                                var panel = jQ.children(".catalog-cart-div");
                                                var shop_btn = panel.children(".shop-btn");
                                                shop_btn.val(pneu_ref);
                                                var label = panel.children("label");
                                                label.attr("for", "qte" + pneu_ref);
                                                var shop_qtt = panel.children("#qte");
                                                shop_qtt.attr('id', 'qte' + pneu_ref);
                                                var item = list.children("a");
                                                var imgDiv = item.children(".logo-img");
                                                jQ.removeClass("model_article");
                                                item.attr("href", "./produit?ref=" + data["resultat"][i]["pneu"]["pneu_ref"]);
                                                var listBody = item.children(".list-group-desc");
                                                listBody.children(".list-group-item-heading").html("<b>" + pneu_description + "</b>");
                                                //console.log(panelBody);
                                                jQ.show();
                                                imgDiv.children("img").attr("src", "../assets/img/logo/" + data["resultat"][i]["pneu"]["pneu_marque"] + ".png");
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
                                            div_articles.html("<h2>Nous somme désolé mais il n'y a aucun pneus correspondant à vos critères de recherches.</h2>");
                                        }
                                    }
                                });
                        }
                    });
                    /**
                     * Gestion du chargement de la page suivante
                     */
                    suiv.click(function () {
                        if (activeNext) {
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
                                                var pneu_marque = data["resultat"][i]["pneu"]["pneu_marque"];
                                                var pneu_categorie = data["resultat"][i]["pneu"]["pneu_categorie"];
                                                var pneu_largeur = data["resultat"][i]["pneu"]["pneu_largeur"];
                                                var pneu_serie = data["resultat"][i]["pneu"]["pneu_serie"];
                                                var pneu_jante = data["resultat"][i]["pneu"]["pneu_jante"];
                                                var pneu_charge = data["resultat"][i]["pneu"]["pneu_charge"];
                                                var pneu_vitesse = data["resultat"][i]["pneu"]["pneu_vitesse"];
                                                var pneu_stock = data["resultat"][i]["pneu"]["pneu_stock"];
                                                console.log(pneu_stock);
                                                var pneu_description = data["resultat"][i]["pneu"]["pneu_description"];
                                                var pneu_prix = data["resultat"][i]["prix"];// Attention peut être à changer pour tenir compte du multplicateur
                                                //console.log(marque);
                                                //console.log("Je boucle" + i);
                                                var pneu_ref = data["resultat"][i]["pneu"]["pneu_ref"];
                                                var jQ = model.clone();
                                                var list = jQ.children(".list-group-item");
                                                var panel = jQ.children(".catalog-cart-div");

                                                var label = panel.children("label");
                                                label.attr("for", "qte" + pneu_ref);
                                                var shop_qtt = panel.children("#qte");
                                                shop_qtt.attr('id', 'qte' + pneu_ref);

                                                var shop_btn = panel.children(".shop-btn");
                                                shop_btn.val(pneu_ref);
                                                var item = list.children("a");
                                                var imgDiv = item.children(".logo-img");
                                                jQ.removeClass("model_article");
                                                item.attr("href", "./produit?ref=" + data["resultat"][i]["pneu"]["pneu_ref"]);
                                                var listBody = item.children(".list-group-desc");
                                                listBody.children(".list-group-item-heading").html("<b>" + pneu_description + "</b>");
                                                //console.log(panelBody);
                                                jQ.show();
                                                imgDiv.children("img").attr("src", "../assets/img/logo/" + data["resultat"][i]["pneu"]["pneu_marque"] + ".png");
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
                                            div_articles.html("<h2>Nous somme désolé mais il n'y a aucun pneu correspondant à vos critères de recherches.</h2>");
                                        }
                                    }

                                });
                        }
                    });


                    /* Ajouter Panier */

                    $(document).on("click", ".shop-btn", function (e) {

                        /*On récupère le div du pneu */
                        var ref = this.value;
                        var selector = "button[value='" + ref + "']";
                        var div_parent = $(selector).parent();
                        var qtt = $("#qte" + ref + " option:selected").val();
                        console.log(qtt);
                        var div_pneu = div_parent.parent();
                        var pneu = div_pneu.children(".list-group-item");
                        var image = pneu.children("a").children(".logo-img");
                        var titre = $("<div class=\"col-md-6\"><h4>" + pneu.children("a").children(".list-group-desc").children("h4").children("b").html() + "</h4></div>");
                        
                        $.post("../assets/php/ajax/panier.php", {
                            action: "ajouterArticle",
                            quantite: qtt,
                            referencePneu: this.value

                        }, function (data) {
                            data = JSON.parse(data);
                            console.log(data);

                            if(data["etat"] == "reussite") {
                                /* On ajout le div du pneu au modal */
                                var modal = $('#modalPneuPanier');
                                var modalDialog = modal.children(".modal-dialog");
                                var contentModal = modalDialog.children(".modal-content");
                                var bodyModal = contentModal.children(".modal-body");

                                bodyModal.children(".row").html("<div class='col-md-3'>" + image.html() + "</div><div class=\"col-md-6\">" + titre.html() + "</div><div class=' col-md-2'><h4>Quantité:" + qtt + "</h4></div>");

                                modal.modal('show');
                            }
                            else if(data["etat"] == "warning") {
                                /* On ajout le div du pneu au modal */
                                var modal = $('#modalPneuPanier');
                                var modalDialog = modal.children(".modal-dialog");
                                var contentModal = modalDialog.children(".modal-content");
                                var bodyModal = contentModal.children(".modal-body");

                                qtt = data["nouvelleQuantite"];

                                bodyModal.children(".row").html('<div class="col-md-12">Le stock était inferieur à la quantité voulue, la quantité à été modifiée à la valeur du stock</div>' +
                                    '<div class="row"> <div class="col-md-3">' + image.html() + '</div><div class=\"col-md-6\">' + titre.html() +'</div>'+
                                    "<div class=' col-md-2'><h4>Quantité:" + qtt + "</h4></div></div>");

                                modal.modal('show');
                            }
                        });

                    });


                });
        });</script>

<?php
include_once("footer.php");
?>