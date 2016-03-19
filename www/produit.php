<?php
include_once "../secret/credentials.php";
include_once("header.php");
?>

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

<script>
    $(document).ready(function () {
        var url = window.location.href;
        var arr = url.split("=");
        var ref = arr[1];

        $.post(
            "../assets/php/ajax/recherche.php",
            {
                action: "chargementRef",
                ref: ref
            },
            function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (data["etat"] == "reussite") {
                    var pneu_marque = data["resultat"][0]["pneu_marque"];
                    var pneu_categorie = data["resultat"][0]["pneu_categorie"];
                    var pneu_largeur = data["resultat"][0]["pneu_largeur"];
                    var pneu_serie = data["resultat"][0]["pneu_serie"];
                    var pneu_jante = data["resultat"][0]["pneu_jante"];
                    var pneu_charge = data["resultat"][0]["pneu_charge"];
                    var pneu_vitesse = data["resultat"][0]["pneu_vitesse"];
                    var pneu_description = data["resultat"][0]["pneu_description"];
                    var pneu_prix = data["resultat"][0]["pneu_prix"];// Attention peut être à changer pour tenir compte du multplicateur
                    var pneu_ref = data["resultat"][0]["pneu_ref"];
                    var jQ = $(".model_article");
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

                }
            });
    });
</script>
<?php
include_once("footer.php");
?>
