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
    
    public static function getCommandeFromBDD($id)
    {
        $res = SQLSelect("SELECT * FROM commande WHERE commande_id=?", [$id]);
        
        if ($res === false)
            return false;
        else
            return new Commande($res[0]);
    }
    
    public static function getCommandeFromData($date, $config_date, $id_facturation, $id_livraison)
    {
        return new Commande(["commande_id" => -1, "commande_date" => $date, "config_date" => $config_date, "adresse_facturation_id" => $id_facturation, "adresse_livraison_id" => $id_livraison]);
    }

    private $commande_id;
    private $commande_date;
    private $config_date;
    private $adresse_facturation;
    private $adresse_livraison;
    private $produits;
}