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

            var pagination = $(".paginat");

            //gestion de l'affichage de la pagination
            if (data["nbrResult"] < 25 && numero_page == 1) {
                pagination.hide();
            }
            else {
                pagination.show();
            }


            /* Gestion des boutons suivant et précédent*/
            var prev = $(".previous");
            var activePrev = false;
            var suiv = $(".next");
            var activeNext = true;
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
                    referencePneu: this.value,
                    quantite: qtt
                }, function (data) {
                    data = JSON.parse(data);
                    console.log(data);

                    /* On ajout le div du pneu au modal */
                    var modal = $('#modalPneuPanier');
                    var modalDialog = modal.children(".modal-dialog");
                    var contentModal = modalDialog.children(".modal-content");
                    var bodyModal = contentModal.children(".modal-body");

                    bodyModal.children(".row").html("<div class='col-md-3'>" + image.html() + "</div><div class=\"col-md-6\">" + titre.html() + "</div><div class=' col-md-2'><h4>Quantité:" + qtt + "</h4></div>");

                    modal.modal('show');
                });

            });


        });
});