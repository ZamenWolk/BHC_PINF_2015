<?php 
session_start();
if(0)//TODO: implémentation de la connection au site Si mauvaise connection etc on détruis la session
    session_destroy();
	
include_once("templates/header.php");
?>

<h2 style="text-align:center"> Conditions générales de vente </h2>
<div>
	<p> <strong>JSPneus</strong> </br>
		Société (Donnez le statut) au capital de X euros </br>
		Siège social (Donnez l'adresse) </br> 
		N° de téléphone X </br>
		Adresse du courrier électronique : bonpneus1@hotmail.fr </br>
		RCS (ou Répertoire des métiers) de .........(lieu) n°...............  </br>
		N° individuel d'identification fiscal X </br>
		Conditions générales de vente des produits vendus sur  <a href="http://www.js-pneus.fr">js-pneus.fr</a> </br>
		Date de dernière mise à jour 02 Mars 2016 </br>
	</p>
	<h3> Article 1 - Objet </h3>
	<p>	Les présentes conditions régissent les ventes par la société JSPneus, MAGNICOURT EN COMTE (62127) de pneus.
	</p>
	<h3> Article 2 - Prix </h3>
	<p>Les prix de nos produits sont indiqués en euros toutes taxes comprises (TVA et autres taxes applicables au jour de la commande), sauf indication contraire et hors frais de traitement et d'expédition. </br>
	En cas de commande vers un pays autre que la France métropolitaine vous êtes l'importateur du ou des produits concernés. Des droits de douane ou autres taxes locales ou droits d'importation ou taxes d'état sont susceptibles d'être exigibles. Ces droits et sommes ne relèvent pas du ressort de la société <strong>JSPneus</strong>. Ils seront à votre charge et relèvent de votre entière responsabilité, tant en termes de déclarations que de paiements aux autorités et organismes compétents de votre pays. Nous vous conseillons de vous renseigner sur ces aspects auprès de vos autorités locales. Toutes les commandes quelle que soit leur origine sont payables en euros.  La société <strong>JSPneus</strong> se réserve le droit de modifier ses prix à tout moment, mais le produit sera facturé sur la base du tarif en vigueur au moment de la validation de la commande et sous réserve de disponibilité. Les produits demeurent la propriété de la société <strong>JSPneus</strong> jusqu'au paiement complet du prix. Attention : dès que vous prenez possession physiquement des produits commandés, les risques de perte ou d'endommagement des produits vous sont transférés. 
	</p>
	<h3> Article 3 - Commandes </h3>
	<p> Vous pouvez passez commande directement sur le site <a href="http://www.js-pneus.fr">js-pneus.fr</a>
	Les informations contractuelles sont présentées en langue française et feront l'objet d'une confirmation au plus tard au moment de la validation de votre commande. La société <strong>JSPneus</strong> se réserve le droit de ne pas enregistrer une commande et de ne pas la confirmer pour quelque raison que ce soit, et plus particulièrement en cas de problème d'approvisionnement, ou en cas de difficulté concernant la commande reçue.   
	</p>
	<h3> Article 4 - Validation de votre commande </h3>
	<p>Toute commande figurant sur le site Internet <a href="http://www.js-pneus.fr">js-pneus.fr</a> suppose l'adhésion aux présentes Conditions Générales. Toute confirmation de commande entraîne votre adhésion pleine et entière aux présentes conditions générales de vente, sans exception ni réserve. L'ensemble des données fournies et la confirmation enregistrée vaudront preuve de la transaction. Vous déclarez en avoir parfaite connaissance. La confirmation de commande vaudra signature et acceptation des opérations effectuées. Un récapitulatif des informations de votre commande et des présentes Conditions Générales, vous sera communiqué en format PDF (Portable Document Format) via l'adresse e-mail de confirmation de votre commande. 
	</p>
	<h3> Article 5 - Paiement </h3>
	<p> Le fait de valider votre commande implique pour vous l'obligation de payer le prix indiqué. Le réglement de vos achats peut s'effectuer en chèque bancaire ou en espèce lors de la réception de vos produits, directement chez vous ou chez <strong>JSPneus</strong>
	</p>
	<h3> Article 6 - Rétractation </h3>
	<p> Conformément aux dispositions de l'article L.121-21 du Code de la Consommation, vous disposez d'un délai de rétractation de 14 jours à compter de la réception de vos produits pour exercer votre droit de rétraction sans avoir à justifier de motifs ni à payer de pénalité. Les retours sont à effectuer dans leur état d'origine et complets (emballage, accessoires, notice). Dans ce cadre, votre responsabilité est engagée. Tout dommage subi par le produit à cette occasion peut être de nature à faire échec au droit de rétractation. Les frais de retour sont à votre charge. En cas d'exercice du droit de rétractation, la société <strong>JSPneus</strong> procédera au remboursement des sommes versées, dans un délai de 14 jours suivant la notification de votre demande et via le même moyen de paiement que celui utilisé lors de la commande. 
	</p>
	<strong>EXCEPTIONS AU DROIT DE RETRACTATION</strong></br>
	<p>Conformément aux dispositions de l'article L.121-21-8 du Code de la Consommation, le droit de rétractation ne s'applique pas à : </p> 
	</div>

<?php
include_once("templates/footer.html");

?>