<?php
include_once("header.php");
?>

    <div class="container-fluid" id="panierMenu">
        <div class="row borderMainBlock"> <!-- création d'une ligne -->

            <div class="col-md-9" id="myPanier">
                <h1 class="align">&nbsp;Mon panier</h1>
                <hr>
                <div class="alert alert-danger" role="alert" id="notConnected">
                    <i class="fa fa-exclamation-triangle fa-fw"></i>
                    <strong>Vous devez être connecté pour passer une commande</strong>
                </div>
                <div class="alert alert-warning" role="alert" id="notEnough">
                    <i class="fa fa-exclamation-triangle fa-fw"></i>
                    <strong>Stock insuffisant</strong>
                </div>
                <div class="row">
                    <div class="col-md-5 align"><u>Produit</u></div>
                    <!--<div class="col-md-2 col-md-offset-2 align"><u>Référence</u></div>-->
                    <div class="col-md-2 align"><u>Prix unitaire</u></div>
                    <div class="col-md-3 align"><u>Quantité</u></div>
                    <div class="col-md-2 align"><u>Total</u></div>
                </div>
                <hr>
                <div class="row item" id="itemId">
                    <div class="col-md-1 align" id="imgItem"><img class="img-responsive" src=""/></div>
                    <div class="col-md-4" id="infoItem"></div>
                    <!--<div class="col-md-2 align" id="refItem"></div>-->
                    <div class="col-md-2 align" id="priceDiv"><span class="spanStyleLeft" id="priceItem"></span></div>
                    <div class="col-md-3 align inputContainer">
                        <div class="input-group buttonGroup align">
                            <input type="number" class="form-control qtField pull-right" placeholder="" min="0"
                                   id="qtItem" value="">
								      <span class="input-group-btn">
								      	<button class="btn btn-secondary deleteButton" type="button" id="delItem">
                                            <i class="fa fa-trash"></i>
                                        </button>
								      </span>
                        </div>
                    </div>
                    <div class="col-md-2 align" id="lotPriceDiv"><span class="spanStyleLeft" id="lotPriceItem"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3" id="blockValidate">
                <div id="titleValidate">Résumé</div>
                <div id="infoValidate">
                    <span id="labelAmountValidate">Nombre d'articles : </span>
                    <span id="amountValidate"></span></br>
                    <span id="labelPriceAmountValidate">Prix total : </span>
                    <span id="priceValidate"></span><span>€</span>
                </div>
                <div id="buttonGroupValidate">
                    <button type="button" class="btn btn-default btn-block" id="throwPanier">Vider le panier</button>
                    <button type="button" class="btn btn-default btn-block" id="goAchat">Continuer vos achats</button>
                    <button type="button" class="btn btn-default btn-block" id="confirmOrder">Passer la commande
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php
include_once("footer.php");
?>