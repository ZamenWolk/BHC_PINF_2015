<?php

include_once "../../../secret/credentials.php";
include_once "../fonctions/maLibSQL.pdo.php";
include_once "../fonctions/Pneu.php";

class Commande
{
    public function Commande($commande)
    {
        $this->commande_id = $commande["commande_id"];
        $this->commande_date = $commande["commande_date"];
        $this->config_date = $commande["config_date"];
        $this->adresse_facturation = $commande["adresse_facturation_id"];
        $this->adresse_livraison = $commande["adresse_livraison_id"];

        $this->commande_etat = self::checkEtat($commande["commande_etat"]) ? $commande["commande_etat"] : "NON_TRAITE";
    }

    public function chargerProduits()
    {
        $res = SQLSelect("SELECT * FROM fait_partie WHERE commande_id=?", [$this->commande_id]);
        $tab = array();

        foreach ($res as $item)
        {
            $pneu = new Pneu(SQLSelect("SELECT * FROM pneu WHERE pneu_ref = ? AND pneu_dateAjoutBDD = ?", [$item["pneu_ref"], $item["pneu_dateAjoutBDD"]]));
            array_push($tab, ["pneu" => $pneu, "quantite" => $item["quantite"]]);
        }
        
        $this->produits = $tab;
    }

    public function setProduits($produits)
    {
        if (is_array($produits))
            $this->produits = $produits;
    }
    
    public static function getCommandeFromData($date, $config_date, $id_facturation, $id_livraison, $commande_etat)
    {
        if (self::checkEtat($commande_etat))
            return new Commande(["commande_id" => -1, "commande_date" => $date, "config_date" => $config_date, "adresse_facturation_id" => $id_facturation, "adresse_livraison_id" => $id_livraison, "commande_etat" => $commande_etat]);
        else
            return false;
    }

    public function inscrireEnBDD()
    {
        $res = SQLInsert("INSERT INTO commande(adresse_facturation_id, adresse_livraison_id, config_date, commande_date, commande_etat) VALUES (?, ?, ?, ?, ?)", [$this->adresse_facturation, $this->adresse_livraison, $this->config_date, $this->commande_date, $this->commande_etat]);

        $this->Commande(SQLSelect("SELECT * FROM commande WHERE commande_id=?", [$res]));

        foreach ($this->produits as $produit)
        {
            $res2 = SQLInsert("INSERT INTO fait_partie(pneu_ref, pneu_dateAjoutBDD, commande_id, quantite) VALUES (?, ?, ?, ?)", [$produit["pneu"]["reference"], $produit["pneu"]["dateAjoutBDD"], $this->commande_id, $produit["quantite"]]);
        }
        
        return $res;
    }

    public function addPrixProduits()
    {
        foreach ($this->produits as &$produit)
        {
            $produit["prixUnitaire"] = $produit["pneu"]->getPrix($this->config_date);
            $produit["prixLot"] = $produit["prixUnitaire"] * $produit["quantite"];
        }
    }
    
    public function prixTotal()
    {
        $prixTotal = 0;

        foreach ($this->produits as $produit)
        {
            $prixTotal += $produit["prixLot"];
        }
        
        return $prixTotal;
    }

    public static function changerEtat($commandeID, $newEtat)
    {
        if (self::checkEtat($newEtat))
            return SQLUpdate("UPDATE commande SET commande_etat = " . $newEtat . " WHERE commande_id = " . $commandeID);
        else
            return false;
    }
    
    public static function checkEtat($etat)
    {
        if ($etat != "NON_TRAITE" && $etat != "TRAITE" && $etat != "TERMINE" && $etat != "ANNULE")
            return false;
        else
            return true;
    }
    
    public static function loadCommandeFromUserID($user_id)
    {
        $res = SQLSelect("SELECT commande.* FROM commande " .
            "INNER JOIN adresse ON adresse.adresse_id = commande.adresse_facturation_id " .
            "INNER JOIN user ON user.user_id = adresse.user_id " .
            "WHERE user.user_id = ? " .
            "ORDER BY commande_date DESC", [$user_id]);

        $tab = array();
        
        if ($res === false)
            return $tab;

        foreach ($res as $item)
        {
            $commande = new Commande($item);
            $commande->chargerProduits();
            array_push($tab, $commande);
        }

        return $tab;
    }

    public static function loadCommandeFromEtat($etat)
    {
        if (!self::checkEtat($etat))
            return false;

        $res = SQLSelect("SELECT * FROM commande WHERE commande_etat = ? ORDER BY commande_date DESC", [$etat]);

        $tab = array();
        
        if ($res === false)
            return $tab;

        foreach ($res as $item)
        {
            $commande = new Commande($item);
            $commande->chargerProduits();
            array_push($tab, $commande);
        }

        return $tab;
    }
    
    public function getCommande()
    {
        return array("ID" => $this->commande_id, "date" => $this->commande_date, "etat" => $this->commande_etat, "config_date" => $this->config_date, "id_facturation" => $this->adresse_facturation, "id_livraison" => $this->adresse_livraison, "produits" => $this->produits);
    }

    private $commande_id;
    private $commande_date;
    private $commande_etat;
    private $config_date;
    private $adresse_facturation;
    private $adresse_livraison;
    private $produits;
}