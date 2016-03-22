<?php
include_once "../fonctions/pdfF.php";
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
	if (!isset($_POST["client_adresse"]) || !isset(($_POST["client_nom"])) || !isset(($_POST["client_prenom"])) || !isset(($_POST["client_panier"])) || !isset($_POST["prix_total"]) || !isset($_POST[""])
		ajaxError("Il manque des arguments", "MISSING_ARGUMENT");
	else {
	$panier = contenuPanier();
	
	$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
	$pdf->AddPage();
	$pdf->addSociete( "JSPneus",
                  "103 boulevard Marcel Wacheux\n" .
                  "62020 BARLIN\n");
	$pdf->fact_dev( "Devis ", "TEMPO" );
	$pdf->temporaire( "Devis de commande" );
	$pdf->addDate(date('d/m/y')); 
	$pdf->addClient(/*$_POST["le_client_nom"] . $_POST["le_client_prenom"]*/ "Pierre");
	$pdf->addPageNumber("1");
	$pdf->addClientAdresse("Mon cul sur la commode du PINF");
	//$pdf->addReglement("Chèque à réception de facture"); si on prévoit un type de réglement
	$pdf->addEcheance(date('Y-m-d', strtotime("+7 day")));
	$pdf->addNumTVA("FR888777666");
	$pdf->addReference("Devis X du ".date('d/m/y') );
	$cols=array( "REFERENCE"    => 12,
				"DESIGNATION"  => 78,
				"QUANTITE"     => 22,
				"P.U. HT"      => 26,
				"MONTANT H.T." => 30,
				"TVA"          => 11 );
	$pdf->addCols( $cols);
	$cols=array( "REFERENCE"    => "L",
				"DESIGNATION"  => "L",
				"QUANTITE"     => "C",
				"P.U. HT"      => "R",
				"MONTANT H.T." => "R",
				"TVA"          => "C" );
	$pdf->addLineFormat($cols);
	$pdf->addLineFormat($cols);

	$y    = 109;
	$line = array( "REFERENCE"    => "REF1",
				"DESIGNATION"  => wordwrap("Good year Cargo G26 8 245/6 R16 110/108R", 16, "\n", true),
				"QUANTITE"     => "1",
				"P.U. HT"      => "103.29",
				"MONTANT H.T." => "103.29",
				"TVA"          => "1" );
	$size = $pdf->addLine( $y, $line );
	$y   += $size + 2;

	$line = array( "REFERENCE"    => "REF2",
				"DESIGNATION"  => wordwrap("Good year Cargo G26 8 245/6 R16 110/108R", 8, "\n",true),
				"QUANTITE"     => "1",
				"P.U. HT"      => "83.21",
				"MONTANT H.T." => "83.21",
				"TVA"          => "1" );
	$size = $pdf->addLine( $y, $line );
	$y   += $size + 2;

	$pdf->addCadreTVAs();
        
	$tot_prods = array( array ( "px_unit" => 103.29, "qte" => 1, "tva" => 1 ),
                    array ( "px_unit" => 83.21, "qte" => 1, "tva" => 1 ));
	$tab_tva = array( "1"       => 19.6,
					"2"       => 5.5);
	/*$params  = array( "RemiseGlobale" => 1,
						"remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
						"remise"         => 0,       // {montant de la remise}
						"remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
					"FraisPort"     => 1,
						"portTTC"        => 10,      // montant des frais de ports TTC
                                                   // par defaut la TVA = 19.6 %
						"portHT"         => 0,       // montant des frais de ports HT
						"portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
					"AccompteExige" => 1,
						"accompte"         => 0,     // montant de l'acompte (TTC)
						"accompte_percent" => 15,    // pourcentage d'acompte (TTC)
					"Remarque" => "Remise(s) dont vous disposez" );
*/
	$pdf->addTVAs( $params, $tab_tva, $tot_prods);
	$pdf->addCadreEurosFrancs();
	$pdf->Output();
	}
	
break;
default : 
	ajaxError("Pas prêt");
}

?>