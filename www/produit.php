<?php
include_once "../secret/credentials.php";
include_once("header.php");
?>
<div class="model_article container-fluid">

    <div class="row heading">
        <div class="col-md-2">
            <img src="../assets/img/pneu.jpg" class="annonce img-responsive"/>
        </div>
        <div class="col-md-10 item-heading-container pull-right">
            <h1 class="item-heading"></h1>
        </div>
    </div>
    <div class="row item-rest">

        <div class="col-md-6 col-md-offset-3">
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
        <div class="col-md-3 add-cart-div">
            <h3 id="price"></h3>
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
    <a href="./catalogue" type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Retour au catalogue</a>
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
                    var heading = jQ.children(".heading");
                    var list = jQ.children(".list-group-item");
                    var itemRest = jQ.children(".item-rest");
                    var desc = itemRest.children(".col-md-6");
                    var title = heading.children(".item-heading-container");
                    jQ.removeClass("model_article");
                    title.children(".item-heading").html(pneu_description);
                    //console.log(panelBody);
                    var dl_specs = desc.children("dl");
                    dl_specs.children(".largeur").html(pneu_largeur);
                    dl_specs.children(".categorie").html(pneu_categorie);
                    dl_specs.children(".serie").html(pneu_serie);
                    dl_specs.children(".jante").html(pneu_jante);

                    var priceDiv = itemRest.children(".add-cart-div");
                    priceDiv.children("#price").html("Prix : " + pneu_prix + " € ");

                }
            });
    });
</script>
<?php
include_once("footer.php");
?>
