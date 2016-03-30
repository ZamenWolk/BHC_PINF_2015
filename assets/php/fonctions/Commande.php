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

//ma bite est un volcan et j'aime ça
    private $commande_id;
    private $commande_date;
    private $config_date;
    private $adresse_facturation;
    private $adresse_livraison;
    private $produits;
}