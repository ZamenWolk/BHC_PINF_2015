<?php
include_once("header.php");
?>

<div class="row"> <!-- création d'une ligne -->
	<h1>Administration</h1>
	<div class="col-md-4" id="menu"> <!-- 8 colonnes pour la zone principale -->
		<h3>Menu</h3>
		<div class="separator">
			<h4>Gestion des comptes</h4>
			<button id="createUser" type="button" class="btn btn-default btn-lg btn-block">Créer un compte utilisateur</button>
			<button id="createModo" type="button" class="btn btn-default btn-lg btn-block">Créer un compte modérateur</button>
			<button id="banUser" type="button" class="btn btn-default btn-lg btn-block">Bannir un compte</button>
		</div>
		<div class="separator">
			<h4>Gestion des commandes</h4>
			<button id="createOrder" type="button" class="btn btn-default btn-lg btn-block">Créer une commande</button>
			<button id="delOrder" type="button" class="btn btn-default btn-lg btn-block">Supprimer une commande</button>
			<button id="modifyOrder" type="button" class="btn btn-default btn-lg btn-block">Modifier une commande</button>
			<button id="acceptOrder" type="button" class="btn btn-default btn-lg btn-block">Valider une commande</button>
		</div>
		<div class="separator">
			<h4>Autre</h4>
			<button id="seeStats" type="button" class="btn btn-default btn-lg btn-block">Accéder aux statistiques</button>
			<button id="modifCoef" type="button" class="btn btn-default btn-lg btn-block">Modifier coefficient des prix</button>
			<button id="newsLetter" type="button" class="btn btn-default btn-lg btn-block">Envoyer une newsletter</button>
			<button id="goMenu" type="button" class="btn btn-default btn-lg btn-block">Retour au menu</button>
		</div>
	</div>
	<div class="col-md-8" id="content">
		<div class="separator2">
			<p>Bienvenue dans le menu d'administration !</p>
			<p>Pour commencer à administrer le site, cliquez sur le bouton correspondant à l'opération que vous souhaitez faire.</p>
		</div>
		<div class="separator2">
			<p>Quelques statistiques :</p>
			<p>Nombre d'utilisateurs connectés : 543</p>
			<p>Nombre de commandes passées ces 7 derniers jours : 54</p>
		</div>
		<p id = "texte">
		
		</p>
	</div>
</div>

<script>

var panier;
var prixTotal;
var newsletter = 0;
var set=0;
$.post("panier.php", {action: "contenuPanier"}, function(data) {
	if (data["etat"] == "reussite")
  {
  	panier = data["panier"];
    prixTotal = data["prixTotal"];
  }
});

			

 $(document).ready(function () {
	 
	 $("#createOrder").click(function(){
		 $.post('../assets/php/ajax/pdf.php',
        {action:"gen_commande",
		client_nom : "George",
		client_prenom : "deLaJungle",
		client_adresse : "La jungle"
		},
		function(data){
			console.log(data);
			//document.open("../assets/php/ajax/test.pdf",'_blank');
			var win = window.open("../assets/php/ajax/test.pdf", '_blank');
			win.focus();
		});
	 });
		
	$("#newsLetter").click(function(){
		
		if(newsletter ==0){
			if(set==0){
				$("#texte").append("<h3>Envoyer un message de newsletter</h3>");
				$("#texte").append("<label for=\"obj\" class=\"sr-only\">Objet</label>");
				$("#texte").append(" <input type=\"text\" class=\"form-control\" id=\"obj\" placeholder=\"Objet\"/> </br>");
             
				$("#texte").append("<textarea id=\"txt\">Votre message</textarea> </br>");
				$("#txt").css("width","100%");
				$("#texte").append("<button id=\"sendNews\" type=\"button\" class=\"btn btn-block btn-default btn-lg\"><i class=\"fa fa-envelope-o\"></i>");
				set=1;
			}
			$(".separator2").hide();
			$("#texte").show();
			newsletter = 1;
		}
		else if (newsletter ==1){
			$(".separator2").show();
			$("#texte").hide();
			newsletter=0;
		}
	});
	$("#sendNews").click(function(){
		console.log("ça clique hein");
	});
		 
	 
	 
 });
</script>
<?php
include_once("footer.php");
?>