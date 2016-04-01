<?php
include_once("header.php");
?>
<div class="container-fluid" id="commandMenu">
    <div class="row">
        <div class="col-md-12" id="blockValidate">
            <div id="titleValidate">Résumé</div>
            <div class="row item" id="itemId">
                <div class="col-md-3 align" id="imgItem"><img src=""/></div>
                <div class="col-md-4" id="infoItem"></div>
                <div class="col-md-2 align" id="priceDiv"><span class="spanStyleLeft" id="priceItem"></span></div>
                <div class="col-md-2 align" id="qte"><span class="spanStyleLeft" id="qteItem"></span></div>
                <div class="col-md-2 align" id="lotPriceDiv"><span class="spanStyleLeft" id="lotPriceItem"></span>
                </div>
            </div>
            <div id="infoValidate">
                <span id="labelAmountValidate" class="pull-right">Nombre d'articles : </span>
                <span id="amountValidate" class="pull-right"></span><br>
                <span id="labelPriceAmountValidate" class="pull-right">Prix total : </span>
                <span id="priceValidate" class="pull-right"></span>
            </div>
            <div id="buttonGroupValidate">
                <button type="button" class="btn btn-default btn-block" id="goAchat">Continuer vos achats</button>
                <button type="button" class="btn btn-default btn-block" id="confirmOrder">Passer la commande
                </button>
            </div>
        </div>
    </div>

</div>
<script src="../assets/js/panier.js"></script>
<?php
include_once("footer.php");
?>
