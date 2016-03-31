<?php

include_once "../fonctions/maLibSQL.pdo.php";

class Commande
{
    public function Commande($commande)
    {
        $this->commande_id = $commande["commande_id"];
        $this->commande_date = $commande["commande_date"];
        $this->config_date = $commande["config_date"];
        $this->adresse_facturation = $commande["adresse_facturation_id"];
        $this->adresse_livraison = $commande["adresse_livraison_id"];
    }

    public function chargerProduits()
    {
        $res = SQLSelect("SELECT * FROM fait_partie WHERE commande_id=?", [$this->commande_id]);
        $tab = array();

        foreach ($res as $item)
        {
            array_push($tab, []); //TODO : a finir
        }
    }

    public function setProduits($produits)
    {
        if (is_array($produits))
            $this->produits = $produits;
    }
    
    public static function getCommandeFromData($date, $config_date, $id_facturation, $id_livraison)
    {
        return new Commande(["commande_id" => -1, "commande_date" => $date, "config_date" => $config_date, "adresse_facturation_id" => $id_facturation, "adresse_livraison_id" => $id_livraison]);
    }

    public function inscrireEnBDD()
    {
        $res = SQLInsert("INSERT INTO commande(adresse_facturation_id, adresse_livraison_id, config_date, commande_date) VALUES (?, ?, ?, ?)", [$this->adresse_facturation, $this->adresse_livraison, $this->config_date, $this->commande_date]);

        $this->Commande(SQLSelect("SELECT * FROM commande WHERE commande_id=?", [$res]));

        foreach ($this->produits as $produit)
        {
            $res = SQLInsert("INSERT INTO fait_partie(pneu_ref, pneu_dateAjoutBDD, commande_id, quantite) VALUES (?, ?, ?, ?)", [$produit["pneu"]["reference"], $produit["pneu"]["dateAjoutBDD"], $this->commande_id, $produit["quantite"]]);
        }
    }

    private $commande_id;
    private $commande_date;
    private $config_date;
    private $adresse_facturation;
    private $adresse_livraison;
    private $produits;
}