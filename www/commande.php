<?php
include_once("header.php");
?>
<div class="container-fluid" id="commandMenu">
    <div class="row">
        <!-- page adresse -->
        <div  class="col-md-12 adresse">
            <div id="titleValidate">Votre adresse :</div>
            <form>
                <div class="row form-group">
                    <label class="col-lg-4 control-label">Adresse:</label>
                    <div class="col-lg-8">
                        <h5 id="cmd_adress"></h5>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-lg-4 control-label">Complément d'adresse:</label>
                    <div class="col-lg-8">
                        <h5 id="cmd_comp_adress"></h5>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-lg-4 control-label">Code postal:</label>
                    <div class="col-lg-8">
                        <h5 id="cmd_postal"></h5>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-lg-4 control-label">Ville:</label>
                    <div class="col-lg-8">
                        <h5 id="cmd_ville"></h5>
                    </div>
                </div>
                <button type="button" class="btn btn-default btn-block" id="modify_adr_cmd">Modifier mon adresse</button>
                <button type="button" class="btn btn-default btn-block" id="validate_adr_cmd">Valider mon adresse</button>
                <button type="button" class="btn btn-default btn-block" id="cancel_adr_cmd">Annuler</button>
            </form>
        </div>
        <!-- page transporteur : livraison à domicile ou en magasin -->
        <div style="display: none" class="col-md-12 transporter">
            <div id="titleValidate">Livraison :</div>
        </div>
        <!-- paiement -->
        <div style="display: none" class="col-md-12 paiement">
            <div id="titleValidate">Paiement :</div>
        </div>


        <!-- Page résumé -->
        <div style="display: none" class="col-md-12 resume" id="blockValidate">
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

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="buttonGroupValidate">
                <button type="button" class="btn btn-default btn-block" id="next_step">Suivant</button>
                <button type="button" class="btn btn-default btn-block" id="goAchat">Annuler</button>
            </div>
        </div>
    </div>

</div>
<script src="assets/js/commande.js"></script>
<?php
include_once("footer.php");
?>
