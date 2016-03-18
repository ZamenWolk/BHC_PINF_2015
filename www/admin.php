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
			<button id="goMenu" type="button" class="btn btn-default btn-lg btn-block">Retour au menu</button>
		</div>
	</div>
	<div class="col-md-8" id="content">
		<div class="separator">
			<p>Bienvenue dans le menu d'administration !</p>
			<p>Pour commencer à administrer le site, cliquez sur le bouton correspondant à l'opération que vous souhaitez faire.</p>
		</div>
		<div class="separator">
			<p>Quelques statistiques :</p>
			<p>Nombre d'utilisateurs connectés : 543</p>
			<p>Nombre de commandes passées ces 7 derniers jours : 54</p>
		</div>
	</div>
</div>

<script>

$(document).ready(function(){
	$("#createOrder").click(function(){
        $.post('../assets/php/fonctions/pdf.php',
        {action:"gen_commande",
		le_client_nom : "George",
		le_client_prenom : "deLaJungle",
		
		},
		function(data){
			console.log(data);
		});
		
        });
    });
</script>
<?php
include_once("footer.php");
?>