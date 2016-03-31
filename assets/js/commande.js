$(document).ready(function() {
    var model = $("#itemId");
    var div_articles = $("#blockValidate");
    var totalPrice = 0;
    var totalQte = 0;
    $.post("../assets/php/ajax/panier.php",
        {action: "contenuPanier"},
        function (data) {
            var jsonData = JSON.parse(data);
            console.log(jsonData);
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
                var qteDiv = jQ.children("#qte");
                var qte = qteDiv.children("#qteItem");
                var imgDiv = jQ.children("#imgItem");

                jQ.children("#infoItem").html(pneu_description);
                imgDiv.children("img").attr("src", "../assets/img/logo/" + data["resultat"][i]["pneu"]["pneu_marque"] + ".png");
                priceUnit.html(prix_unit + "€");
                qte.html(pneu_quantite);
                priceLot.html(prix_lot + "€");
                jQ.removeClass("#itemId");
                jQ.show();

                div_articles.append(jQ);

                totalQte += pneu_quantite;
                totalPrice += prix_lot;
            }
            $("#priceValidate").html(totalPrice);
            $("#amountValidate").html(totalQte);
            model.hide();
        }
    );
});


