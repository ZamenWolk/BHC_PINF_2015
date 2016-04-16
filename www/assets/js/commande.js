$(document).ready(function() {
    /*var model = $("#itemId");
    var div_articles = $("#blockValidate");
    var totalPrice = 0;
    var totalQte = 0;
    $.post("assets/php/ajax/panier.php",
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
                imgDiv.children("img").attr("src", "assets/img/logo/" + data["resultat"][i]["pneu"]["marque"].toLowerCase() + ".png");
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
    );*/

    var step =0;
    $("#validate_adr_cmd").hide();
    $("#cancel_adr_cmd").hide();
    $.post("../www/assets/php/ajax/user.php",{action:"getConnectedUser"},
        function(user)
        {
            user = JSON.parse(user);
            $.post(
                "../www/assets/php/ajax/adresse.php",

                {
                    action: "getAdresse",
                    user_id: user["user"].ID
                },

                function(adresse)
                {
                    adresse =JSON.parse(adresse);
                    var id_adresse = adresse["adresse"].adresse_id;//En cas de modification
                    console.log(adresse);
                    $("#cmd_adress").html(adresse["adresse"].adresse_ligne1);
                    $("#cmd_comp_adress").html(adresse["adresse"].adresse_ligne2);
                    $("#cmd_postal").html(adresse["adresse"].adresse_codeP);
                    $("#cmd_ville").html(adresse["adresse"].adresse_ville);

                    $('#modify_adr_cmd').click(function () {
                        $("#validate_adr_cmd").show();
                        $("#cancel_adr_cmd").show();
                        $("#modify_adr_cmd").hide();
                        $('h5').each(function () {
                            var elemH5 = $(this);
                            elemH5.replaceWith("<input id='" + $(this).attr("id") + "'  class='champs form-control' type='text' value='" + $(this).html() + "'>");
                        });
                        //$("#ins_newsletter").replaceWith('<input type="checkbox" name="ins_newsletter" id="ins_newsletter" autocomplete="off"/>');
                        //$("#checkbox").show();
                        /*if (newsletter == 1) {
                            $("#ins_newsletter").prop("checked", true);
                        }*/
                    });

                    var ligne1 = adresse["adresse"].adresse_ligne1 ;
                    var ligne2 =adresse["adresse"].adresse_ligne2;
                    var codeP =adresse["adresse"].adresse_codeP;
                    var ville = adresse["adresse"].adresse_ville;
                    var user_id = user.user.ID;
                    $(document).on("change", "#cmd_adress", function () {
                        ligne1 = $(this).val();
                    });
                    $(document).on("change", "#cmd_comp_adress", function () {
                        ligne2 = $(this).val();
                    });
                    $(document).on("change", "#cmd_postal", function () {
                        codeP = $(this).val();
                    });
                    $(document).on("change", "#cmd_ville", function () {
                        ville = $(this).val();
                    });
                    $("#validate_adr_cmd").click(function()
                    {
                        $("#validate_adr_cmd").hide();
                        $("#cancel_adr_cmd").hide();
                        $("#modify_adr_cmd").show();
                        $.post(
                                "assets/php/ajax/adresse.php",
                                {
                                    action: "setAdresse",
                                    user_id: user_id,
                                    adresse_ligne1: ligne1,
                                    adresse_ligne2: ligne2,
                                    adresse_codeP: codeP,
                                    adresse_ville: ville
                                }, function (data) {
                                    data = JSON.parse(data);
                                    console.log(data);
                                    $('.champs').each(function () {
                                        var elemH5 = $(this);
                                        elemH5.replaceWith("<h5 id='" + $(this).attr("id")+ "'>"+$(this).val()+"</h5>");
                                    });
                                }
                        );
                    }

                    );

                    $("#cancel_adr_cmd").click(
                        function ()
                        {
                            $("#validate_adr_cmd").hide();
                            $("#cancel_adr_cmd").hide();
                            $("#modify_adr_cmd").show();
                            $('.champs').each(function () {
                                var elemH5 = $(this);
                                elemH5.replaceWith("<h5 id='" + $(this).attr("id")+ "'></h5>");
                            });
                            $.post(
                                "assets/php/ajax/adresse.php",
                                {
                                    action: "getAdresse",
                                    user_id: user_id
                                },
                                function (data2) {
                                    data2 = JSON.parse(data2);
                                    console.log(data2);
                                    if (data2["etat"] == "reussite") {
                                        var ligne1 = data2["adresse"]["adresse_ligne1"];
                                        var ligne2 = data2["adresse"]["adresse_ligne2"];
                                        var codeP = data2["adresse"]["adresse_codeP"];
                                        var ville = data2["adresse"]["adresse_ville"];

                                        $("#cmd_adress").html(ligne1);
                                        $("#cmd_comp_adress").html(ligne2);
                                        $("#cmd_postal").html(codeP);
                                        $("#cmd_ville").html(ville);
                                    }
                                });
                        }
                    );


                    $("#next_step").click(function(){
                        if(step == 0)
                        {
                            $(".adresse").hide('slow');
                            $(".transporter").show('slow');

                        }
                        if(step == 1)
                        {
                            $(".transporter").hide('slow');
                            $(".paiement").show('slow');
                        }
                        if(step == 2)
                        {
                            $(".paiement").hide('slow');
                            $(".resume").show('slow');
                            $("#next_step").html("Terminer");
                            $("#goAchat").hide('slow');
                        }
                        step++;
                    });
                }
            );

        }
    );
});


