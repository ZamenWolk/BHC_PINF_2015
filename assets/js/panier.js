var myItemId = 0;
var maxId = 0;
var i = 0;
var modeTest = true;

$(document).ready(function() {
	if (modeTest) {
		ajouterArticle("00258",1);
		ajouterArticle("03453",4);
		//ajouterArticle("03999453",4);
		//ajouterArticle("03453",0);
		generatePanier();
		if(!isEmptyPanier()) initId();
	}
	
	else {
		generatePanier();
		if(!isEmptyPanier()) initId();
	}
	
	$("#confirmOrder").click(function() {
    	document.location.href="https://www.youtube.com/watch?v=dQw4w9WgXcQ";
    });
    
    $("#goAchat").click(function() {
    	document.location.href="https://www.youtube.com/watch?v=dQw4w9WgXcQ";
    });

	$(".qtField").change(function () {
	    myItemIdTemp = $(this).attr('id').split("m");
	    myItemId=myItemIdTemp[1];
	    var qt = parseInt($("#qtItem".concat(myItemId)).val());
	    $("#qtItem".concat(myItemId)).val(qt);
		majPrix();
		majPrixTotal();
		majQt();
	});

	$(".deleteButton").click(function () {
		myItemIdTemp = $(this).attr('id').split("m");
	    myItemId=".item".concat(myItemIdTemp[1]);
	    $(myItemId).remove();
	    majPrix();
		majPrixTotal();
		majQt();
		isEmptyPanier();
	});
	
	$("#throwPanier").click(function () {
		$("#panierMenu").html(
	    	'<h1>&nbsp;Mon panier</h1></br>'+
	    	'<p>Votre panier est vide. Les articles que vous mettez dans votre panier sont affichés ici. Pour ajouter des articles dans votre panier, visitez le site et sélectionnez les articles qui vous intéressent.</p>');
	    $("#blockValidate").remove();
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
		for(var i = 1; i <= maxId; i++) {
			if (parseFloat($("#totalPriceItem".concat(i)).text())) priceTot = priceTot + parseFloat($("#totalPriceItem".concat(i)).text());
		}
		$("#priceValidate").text(priceTot.toFixed(2));
		$("#totalPrice").text(priceTot.toFixed(2));
	}
	
	function majQt() {
		var qtTot = 0;
		var qtItemId = "";
		for(var i = 1; i <= maxId; i++) {
			qtItemId = "#qtItem".concat(i);
			if (parseInt($(qtItemId).val())) qtTot = qtTot + parseInt($(qtItemId).val());
			//alert(qtTot);
		}
		$("#amountValidate").text(qtTot);
	}
	
	function initId() {
    	i = 1;
	    if ($("#itemId".concat(i)) == null) $("#myPanier").html(
	    	'<h1>&nbsp;Mon panier</h1></br>'+
	    	'<p>Votre panier est vide. Les articles que vous mettez dans votre panier sont affichés ici. Pour ajouter des articles dans votre panier, visitez le site et sélectionnez les articles qui vous intéressent.</p>'
	    );
	    
	    else {
	    	while($("#itemId".concat(i)).html() != null) {
				maxId++;
				i++;
			}
	    	majPrixTotal();
			majQt();
			//alert(maxId + "=initId");
	    }
    }
    
    function isEmptyPanier() {
    		var vide = 1;
    		var itemIdTest = "";
    		
			for(var i = 1; i <= maxId; i++) {
				if ($("#itemId".concat(i)).html() != null) vide = 0;
			}
			
			if (vide) {
				$("#panierMenu").html(
	    	'<h1>&nbsp;Mon panier</h1></br>'+
	    	'<p>Votre panier est vide. Les articles que vous mettez dans votre panier sont affichés ici. Pour ajouter des articles dans votre panier, visitez le site et sélectionnez les articles qui vous intéressent.</p>');
	    		$("#blockValidate").remove();
	    		return true;
			}
			
			else return false;
    }
    
    function generatePanier() {
    	$.post("../assets/php/ajax/panier.php", 
    			{action : "contenuPanier"}, 
    			function(data) {
    				var jsonData = JSON.parse(data);
	    			console.log(jsonData["panier"][0]);
    			}
    		);
    }
    
    function ajouterArticle(reference, qt) {
    	$.post("../assets/php/ajax/panier.php",
    			{action : "ajouterArticle",referencePneu:reference,quantite:qt}, 
    			function(data) {
	    			console.log(data);
    			}
    		); 
    }	
    ///////////// FONCTION DE DEBUG ////////////////
    
    /*$("#myPanier").html('<h1 class="align">&nbsp;Mon panier</h1><hr>'+
            	'<div class="row">'+ 
            	'	<div class="col-md-1 align"><u>Produit</u></div>'+
            	'	<div class="col-md-2 col-md-offset-2 align"><u>Référence</u></div>'+
            	'	<div class="col-md-2 align"><u>Prix unitaire</u></div>'+
            	'	<div class="col-md-3 align"><u>Quantité</u></div>'+
            	'	<div class="col-md-2 align"><u>Total</u></div>'+
            	'</div><hr>'+
            	'<div class="row item1" id="itemId1">'+
            	'	<div class="col-md-1 align" id="imgItem1"><img src="../assets/img/item1.jpg" height="60px" width="60px"/></div>'+
            	'	<div class="col-md-2" id="infoItem1">Thor miniature - version plastique</div>'+
            	'	<div class="col-md-2 align" id="refItem1"">PN029438</div>'+
            	'	<div class="col-md-2 align"><span class="spanStyleLeft" id="priceItem1">1.00</span><span class="spanStyleRight">€</span></div>'+
            	'	<div class="col-md-3 align">'+
            	'		  <div class="input-group buttonGroup align">'+
				'		      <input type="number" class="form-control qtField pull-right" placeholder="" min="0" id="qtItem1" value="1">'+
				'		      <span class="input-group-btn">'+
				'		      	<button class="btn btn-secondary glyphicon glyphicon-trash deleteButton" type="button" id="delItem1"></button>'+
				'		      </span>'+
				'		  </div>'+
            	'	</div>'+
            	'	<div class="col-md-2 align"><span class="spanStyleLeft" id="totalPriceItem1">1.00</span><span class="spanStyleRight">€</span></div>'+
            	'</div><hr class="item1">'+
            	'<div class="row item2" id="itemId2">'+
            	'	<div class="col-md-1 align" id="imgItem2"><img src="../assets/img/item1.jpg" height="60px" width="60px"/></div>'+
            	'	<div class="col-md-2" id="infoItem2">Thor miniature - version plomb</div>'+
            	'	<div class="col-md-2 align" id="refItem2"">PN029439</div>'+
            	'	<div class="col-md-2 align"><span class="spanStyleLeft" id="priceItem2">2.50</span><span class="spanStyleRight">€</span></div>'+
            	'	<div class="col-md-3 align">'+
            	'		  <div class="input-group buttonGroup">'+
				'		      <input type="number" class="form-control qtField pull-right" placeholder="" min="0" id="qtItem2" value="3">'+
				'		      <span class="input-group-btn">'+
				'		      	<button class="btn btn-secondary glyphicon glyphicon-trash deleteButton" type="button" id="delItem2"></button>'+
				'		      </span>'+
				'		  </div>'+
            	'	</div>'+
            	'	<div class="col-md-2 align"><span class="spanStyleLeft" id="totalPriceItem2">7.50</span><span class="spanStyleRight">€</span></div>'+
            	'</div><hr class="item2">');*/

});