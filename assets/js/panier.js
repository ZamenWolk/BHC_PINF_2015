var myItemId = 0;
var maxId = 0;
var i = 0;

$(document).ready(function () {

    generatePanier();
    $("#notConnected").hide();

    $("#confirmOrder").click(function () {
        $.post(
            "../assets/php/ajax/user.php",
            {
                action: "getConnectedUser"
            },
            function (data) {
                data = JSON.parse(data);
                if(data["etat"] == "reussite") {
                    document.location.href = "./commande";
                }
                else $("#notConnected").slideDown();
            });
    });

    $("#goAchat").click(function () {
        document.location.href = "./recherche?marque=0&largeur=0&serie=0&jante=0&charge=0&categorie=0&vitesse=0&consommation=0&decibel=0";
    });

    $(".qtField").change(function () {
        myItemIdTemp = $(this).attr('id').split("m");
        myItemId = myItemIdTemp[1];
        var qt = parseInt($("#qtItem".concat(myItemId)).val());
        $("#qtItem".concat(myItemId)).val(qt);
        majPrix();
        majPrixTotal();
        majQt();
    });

    $(document).on("click",".deleteButton", function () {
        var ref = $(this).attr("id");
        console.log(ref);
        $.post("../assets/php/ajax/panier.php",
            {
                action:"retirerArticle",
                referencePneu: ref
            }, function(data) {
            }
        )
    });

    $("#throwPanier").click(function () {
        $.post("../assets/php/ajax/panier.php",
            {
                action: "vider"
            }, function (data) {
                
            }
        );
    });

    function majPrix() {
        var price = $("#priceItem".concat(myItemId)).text();
        var qt = $("#qtItem".concat(myItemId)).val();
        //alert(totalPriceItemMaj + "///" + price * qt);
        $("#totalPriceItem".concat(myItemId)).text((price * qt).toFixed(2));
    }

    function majPrixTotal() {
        var priceTot = 0;
        var totalPriceItemId = "";
        //alert(maxId+ "majPrixTotal");
        for (var i = 1; i <= maxId; i++) {
            if (parseFloat($("#totalPriceItem".concat(i)).text())) priceTot = priceTot + parseFloat($("#totalPriceItem".concat(i)).text());
        }
        $("#priceValidate").text(priceTot.toFixed(2));
        $("#totalPrice").text(priceTot.toFixed(2));
    }

    function majQt() {
        var qtTot = 0;
        var qtItemId = "";
        for (var i = 1; i <= maxId; i++) {
            qtItemId = "#qtItem".concat(i);
            if (parseInt($(qtItemId).val())) qtTot = qtTot + parseInt($(qtItemId).val());
            //alert(qtTot);
        }
        $("#amountValidate").text(qtTot);
    }

    function initId() {
        i = 1;
        if ($("#itemId".concat(i)) == null) $("#myPanier").html(
            '<h1>&nbsp;Mon panier</h1></br>' +
            '<p>Votre panier est vide. Les articles que vous mettez dans votre panier sont affichés ici. Pour ajouter des articles dans votre panier, visitez le site et sélectionnez les articles qui vous intéressent.</p>'
        );

        else {
            while ($("#itemId".concat(i)).html() != null) {
                maxId++;
                i++;
            }

            //alert(maxId + "=initId");
        }
    }

    function isEmptyPanierAndInit() {
        $.post("../assets/php/ajax/panier.php",
            {action: "nbArticles"},
            function (data) {
                var jsonData = JSON.parse(data);
                var nbArticles = jsonData["nbArticles"];
                if (nbArticles == 0) $("#myPanier").html(
                    '<h1>&nbsp;Mon panier</h1></br>' +
                    '<p>Votre panier est vide. Les articles que vous mettez dans votre panier sont affichés ici. Pour ajouter des articles dans votre panier, visitez le site et sélectionnez les articles qui vous intéressent.</p>'
                );
                else {
                    maxId = nbArticles;
                    console.log("maxId =" + maxId);
                    majPrixTotal();
                    majQt();
                }
            }
        );
    }

    function generatePanier() {
        var model = $("#itemId");
        var div_articles = $("#myPanier");
        var totalPrice = 0;
        var totalQte = 0;
        $.post("../assets/php/ajax/panier.php",
            {action: "contenuPanier"},
            function (data) {
                var jsonData = JSON.parse(data);
                console.log(jsonData);
                if(jsonData["panier"].length > 0) {
                    for (var i = 0; i < jsonData["panier"].length; i++) {
                        var pneu_description = jsonData["panier"][i]["pneu"]["description"];
                        var pneu_reference = jsonData["panier"][i]["pneu"]["reference"];
                        var pneu_quantite = jsonData["panier"][i]["quantite"];
                        var prix_unit = jsonData["panier"][i]["prixUnitaire"];
                        var prix_lot = jsonData["panier"][i]["prixLot"];
                        var jQ = model.clone();
                        var priceDiv = jQ.children("#priceDiv");
                        var priceUnit = priceDiv.children("#priceItem");
                        var priceLotDiv = jQ.children("#lotPriceDiv");
                        var priceLot = priceLotDiv.children("#lotPriceItem");
                        var input = jQ.children(".inputContainer").children(".input-group");
                        var qtField = input.children(".qtField");

                        jQ.children("#infoItem").html(pneu_description);
                        //jQ.children("#refItem").html(pneu_reference);
                        priceUnit.html(prix_unit + "€");
                        qtField.attr("value", pneu_quantite);
                        priceLot.html(prix_lot + "€");
                        jQ.removeClass("#itemId");
                        jQ.show();

                        div_articles.append(jQ);

                        var trashBtn = jQ.children(".inputContainer").children(".input-group").children(".input-group-btn").children(".deleteButton");
                        trashBtn.attr("id",pneu_reference);

                        totalQte += pneu_quantite;
                        totalPrice += prix_lot;
                    }
                } else $("#confirmOrder").attr("disabled","disabled");

                $("#priceValidate").html(totalPrice);
                $("#amountValidate").html(totalQte);
                model.hide();
            }
        );
    }

    function ajouterArticle(reference, qt) {
        $.post("../assets/php/ajax/panier.php",
            {action: "ajouterArticle", referencePneu: reference, quantite: qt},
            function (data) {
                // console.log(data);
            }
        );
    }

});