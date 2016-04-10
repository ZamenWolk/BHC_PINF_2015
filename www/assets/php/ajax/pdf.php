<?php
include_once "../fonctions/pdf.php";
include_once("../fonctions/AJAX.php");

session_start();

if (!isset($_POST["action"]))
{
    ajaxError("Action non définie", "UNDEFINED_ACTION");
}

$action = $_POST["action"];
switch($action)
{
	case "gen_commande" : 
	if (!isset($_POST["client_adresse"]) || !isset($_POST["client_nom"]) || !isset($_POST["client_prenom"]) )
		ajaxError("Il manque des arguments", "MISSING_ARGUMENT");
else {
	$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
	$pdf->AddPage();
	$pdf->addSociete( "JSPneus",
                  "103 boulevard Marcel Wacheux\n" .
                  "62020 BARLIN\n");
	$pdf->fact_dev( "Devis ", "TEMPO" );
	$pdf->temporaire( "Devis de commande" );
	$pdf->addDate(date('d/m/y')); 
	$pdf->addClient($_POST["client_nom"] . $_POST["client_prenom"]);
	$pdf->addPageNumber("1");
	//TODO : Ajouter adresse du client
	//$pdf->addClientAdresse("Mon cul sur la commode du PINF");
	//TODO: Gérer les différents types de paiement
	//$pdf->addReglement("Chèque à réception de facture"); si on prévoit un type de réglement
	$pdf->addEcheance(date('Y-m-d', strtotime("+7 day")));
	$pdf->addNumTVA("FR888777666");
	$pdf->addReference("Devis X du ".date('d/m/y') );
	$cols=array( "REF."    => 14,
				"DESIGNATION"  => 78,
				"QUANTITE"     => 22,
				"P.U. HT"      => 26,
				"MONTANT H.T." => 30,
				"TVA"          => 11 );
	$pdf->addCols( $cols);
	$cols=array( "REF."    => "L",
				"DESIGNATION"  => "L",
				"QUANTITE"     => "C",
				"P.U. HT"      => "R",
				"MONTANT H.T." => "R",
				"TVA"          => "C" );
	$pdf->addLineFormat($cols);
	$pdf->addLineFormat($cols);

	$y    = 109;
	$tot_prods = array();
	foreach($_POST["panier"] as $row) {
		$line = array("REF." => $row["pneu"]["reference"],
			"DESIGNATION" => wordwrap($row["pneu"]["description"], 16, "\n", true),
			"QUANTITE" => $row["quantite"],
			"P.U. HT" => $row["prixUnitaire"],
			"MONTANT H.T." => $row["prixLot"],
			"TVA" => "19.6");
		$size = $pdf->addLine($y, $line);
		$y += $size + 2;
		array_push($tot_prods, array("px_unit" => $row["prixUnitaire"], "qte" => $row["quantite"],"tva" => 1));
	}


	$pdf->addCadreTVAs();

	/*$tot_prods = array( array ( "px_unit" => $row["pneu"]["reference"], "qte" => 1, "tva" => 1 ),
                    array ( "px_unit" => 83.21, "qte" => 1, "tva" => 1 ));*/
	$tab_tva = array( "1"       => 19.6,
					"2"       => 5.5);
	$params  = array( "RemiseGlobale" => 1,
						"remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
						"remise"         => 0,       // {montant de la remise}
						"remise_percent" => 0,      // {pourcentage de remise sur ce montant de TVA}
					"FraisPort"     => 1,
						"portTTC"        => 10,      // montant des frais de ports TTC
                                                   // par defaut la TVA = 19.6 %
						"portHT"         => 0,       // montant des frais de ports HT
						"portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
					"AccompteExige" => 1,
						"accompte"         => 0,     // montant de l'acompte (TTC)
						"accompte_percent" => 0,    // pourcentage d'acompte (TTC)
					"Remarque" => "Remise(s) dont vous disposez" );

	$pdf->addTVAs( $params, $tab_tva, $tot_prods);
	$pdf->addCadreEurosFrancs();
	//$tab=array("pdf" => $pdf->Output("S"));
	$pdf->Output("F","./test2.pdf");
	$_SESSION["pdf"] = $pdf->Output("S");//TODO: Supprimer le fichier juste aprés
	ajaxSuccess(array("etat2"=> "réussite", "pdf" => $_SESSION["pdf"]));
	}
	
break;
	case "getPdf":
		if(isset($_SESSION["pdf"]))
		{
			ajaxSuccess(array("pdf" => $_SESSION["pdf"]));
		}
		else
			ajaxError("Erreur: pas de pdf", "NO_PDF");
		break;
default : 
	ajaxError("Pas prêt");
}

?>