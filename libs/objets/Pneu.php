<?php

class Pneu
{
    function Pneu($pneu)
    {
        $this->EAN = $pneu["pneu_ean"];
        $this->reference = $pneu["pneu_ref"];
        $this->marque = $pneu["pneu_marque"];
        $this->categorie = $pneu["pneu_categorie"];
        $this->description = $pneu["pneu_description"];
        $this->largeur = $pneu["pneu_largeur"];
        $this->serie = $pneu["pneu_serie"];
        $this->jante = $pneu["pneu_jante"];
        $this->charge = $pneu["pneu_charge"];
        $this->vitesse = $pneu["pneu_vitesse"];
        $this->profil = $pneu["pneu_profil"];
        $this->decibel = $pneu["pneu_decibel"];
        $this->bruit = $pneu["pneu_bruit"];
        $this->consommation = $pneu["pneu_consommation"];
        $this->adherance = $pneu["pneu_adherance"];
        $this->categorieEtiquette = $pneu["pneu_categorieEtiquette"];
        $this->stock = $pneu["pneu_stock"];
        $this->prix = $pneu["pneu_prix"];
        $this->dateAjoutBDD = $pneu["pneu_dateAjoutBDD"];
    }

    public $EAN;
    public $reference;
    public $marque;
    public $categorie;
    public $description;
    public $largeur;
    public $serie;
    public $jante;
    public $charge;
    public $vitesse;
    public $profil;
    public $decibel;
    public $bruit;
    public $consommation;
    public $adherance;
    public $categorieEtiquette;
    public $stock;
    public $prix;
    public $dateAjoutBDD;
}