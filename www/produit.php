<?php
include_once "../secret/credentials.php";
include_once("header.php");
?>

<div class="row">
    <div class="well">
        <div class="list-group" id="articles">
            <div class="model_article">
                <a href="#" id="item-link" class="list-group-item">
                    <h3 class="list-group-item-heading"></h3>
                    <div class="media col-md-3">
                        <figure class="pull-left">
                            <img src="../assets/img/pneu.jpg" class="annonce img-responsive"/>
                        </figure>
                    </div>
                    <div class="col-md-6 list-group-desc">
                        <ul>
                            <li class="categorie">Catégorie:</li>
                            <li class="largeur">Largeur:</li>
                            <li class="serie">Serie:</li>
                            <li class="jante">Jante:</li>
                        </ul>
                    </div>
                    <div class="col-md-3 text-center price-div">
                        <h2 id="price">Prix:</h2>
                    </div>
                </a>
                <button type="button" class="btn btn-default btn-lg btn-block shop-btn"><span
                        class="fa fa-shopping-cart"
                        aria-hidden="true"></span> Ajouter au panier </button>
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
                    var item = jQ.children("a");
                    jQ.removeClass("model_article");
                    item.children(".list-group-item-heading").html("<a href=\"./produit?ref=" + pneu_ref + "\"><b>" + pneu_description + "</b></a>");
                    var listBody = item.children(".list-group-desc");
                    //console.log(panelBody);
                    var ul_specs = listBody.children("ul");
                    ul_specs.children(".largeur").html("Largeur:  " + pneu_largeur);
                    ul_specs.children(".categorie").html("Categorie: " + pneu_categorie);
                    ul_specs.children(".serie").html("Serie:  " + pneu_serie);
                    ul_specs.children(".jante").html("Jante:  " + pneu_jante);

                    var priceDiv = item.children(".price-div");
                    priceDiv.children("#price").html("Prix : " + pneu_prix + " € ");

                }
            });
    });
</script>
<?php
include_once("footer.php");
?>
