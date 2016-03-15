<?php
include_once("header.php");
?>

<div style="margin-top: 40px;"/>
<div class="container" id="panierMenu"> 
        <div class="row borderMainBlock"> <!-- création d'une ligne -->
            <div class="col-md-9" id="myPanier"> 


            	<div class="row">
            		<div class="col-md-2 col-md-offset-9 spanStyleBlock align"> 
            			<span>Prix total :&nbsp;</span>
            			<span id="totalPrice"></span><span>€</span>
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
					   <button type="button" class="btn btn-default btn-block" id="confirmOrder">Passer la commande</button>
				</div>
            </div>
            </div> 
      </div>
      </div>
    </div>
	<div id="erreur"></div>
<?php
include_once("footer.php");
?>