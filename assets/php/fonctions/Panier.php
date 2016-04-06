<?php

include_once "../fonctions/Pneu.php";
include_once "../../../secret/credentials.php";
include_once("../fonctions/Config.php");

class Panier
{
	/**
	*  
	* @brief Crée un tableau représentant un panier
	*
	**/
    public function Panier()
    {
        $this->panier = array();
    }
	
	/**
	*  
	* @brief Vide le panier
	*
	**/
    public function vider()
    {
        $this->panier = array();
    }

	/**
	*  
	* @brief Compte le nombre d'article(s) dans le panier
	* @return int nombre d'élément(s) dans le panier
	*
	**/
    public function nbArticles()
    {
        return count($this->panier);
    }

	/**
	*  
	* @brief Ajoute un article au panier
	* @param pneu Pneu que l'on veut ajouter
	* @param quantite Quantité que l'on veut ajouter au panier
	* @return boolean|int false si le pneu n'est pas un objet "Pneu" ou si la quantité est inférieur à 1, 0 ou la quantité mise à jour
	*
	**/
    public function ajouterArticle($pneu, $quantite)
    {
        if (!($pneu instanceof Pneu) || $quantite < 1)
            return false;

        if (!$this->getArticle($pneu->reference))
            array_push($this->panier, array("pneu" => $pneu, "quantite" => 0));

        $suppr = $this->getArticle($pneu->reference)["quantite"];
        
        return $this->ajouterQuantite($pneu->reference, $quantite) - $suppr;
    }

	/**
	*  
	* @brief Retire un article au panier
	* @param string reference Référence du pneu que l'on veut retirer du panier
	* @return boolean|boolean true si le pneu a bien été retiré, false si le retrait n'a pas pu être fait
	*
	**/
    public function retirerArticle($reference)
    {
        if ($this->getArticle($reference))
        {
            foreach ($this->panier as $key => $item)
            {
                if ($item["pneu"]->reference == $reference)
                {
                    unset($this->panier[$key]);
                    $this->panier = array_values($this->panier);
                    return true;
                }
            }
        }

        return false;
    }

	/**
	*  
	* @brief Ajoute une quantité à un pneu donné
	* @param string reference Référence du pneu dont on veut ajouter une quantité 
	* @param int quantite Quantité que l'on veut ajouter à la quantité actuelle
	* @return boolean|int False si la quantité est négative ou si la référence n'est pas bonne, 0 ou la nouvelle quantité 
	*
	**/
    public function ajouterQuantite($reference, $quantite)
    {
        if (!$this->getArticle($reference) || $quantite < 0)
            return false;
        else
        {
            $item = &$this->getArticle($reference);
            return $this->changerQuantite($reference, $item["quantite"] + $quantite);
        }
    }

	/**
	*  
	* @brief Retire une quantité à un pneu donné
	* @param string reference Référence du pneu dont on veut retirer une certaine quantité
	* @param int quantite Quantité que l'on veut retirer à la quantité actuelle
	* @return boolean|int False si la quantité est négative ou si la référence n'est pas bonne, 0 ou la nouvelle quantité 
	*
	**/
    public function retirerQuantite($reference, $quantite)
    {
        if (!$this->getArticle($reference) || $quantite < 0)
            return false;
        else
        {
            $item = &$this->getArticle($reference);
            return $this->changerQuantite($reference, $item["quantite"] - $quantite);
        }
    }

	/**
	*  
	* @brief Changer la quantité d'un un pneu donné
	* @param string reference Référence du pneu dont on veut modifier la quantité
	* @param int quantite Quantité que l'on veut attribuer au pneu
	* @return boolean|int|int|int False si la quantité est négative ou si la référence n'est pas bonne, 0 si la quantité est nulle, quantité actuelle si la quantité est différente de 0
	*
	**/
    public function changerQuantite($reference, $quantite)
    {
        if (!$this->getArticle($reference) || $quantite < 0)
            return false;

        $stock = Pneu::getStock($reference);
        if ($stock < $quantite)
            return $this->changerQuantite($reference, $stock);

        $item = &$this->getArticle($reference);

        if ($quantite == 0)
        {
            $this->retirerArticle($reference);
            return 0;
        }
        else
        {
            $item["quantite"] = $quantite;
            return $quantite;
        }
    }

	/**
	*  
	* @brief Permet de récupérer le prix d'un pneu multiplié par sa quantité pour obtenir un prix de lot
	* @param string reference du pneu dont on veut obtenir le prix de lot
	* @return float|boolean Prix arrondi du lot à la 2eme décimale, false si le pneu que l'on veut utiliser n'est pas mise en place
	*
	**/
    public function prixLot($reference)
    {
        $item = &$this->getArticle($reference);
        if (isset($item))
        {
            return round($item["pneu"]->getPrix() * $item["quantite"], 2);
        }
        else
            return false;
    }

	/**
	*  
	* @brief Permet de récupérer le prix d'un pneu 
	* @param string reference du pneu dont on veut obtenir le prix 
	* @return float prix du pneu 
	*
	**/
    public function prixUnitaire($reference)
    {
        $item = &$this->getArticle($reference);
        if (isset($item))
        {
            return $item["pneu"]->getPrix();
        }
        else
            return false;
    }

	/**
	*  
	* @brief Permet de récupérer le prix total du panier
	* @return float total Le prix du panier
	*
	**/
    public function prixTotal()
    {
        $total = 0;

        foreach ($this->panier as $item)
        {
            $total += $this->prixLot($item["pneu"]->reference);
        }

        return round($total, 2);
    }

	/**
	*  
	* @brief Permet de récupérer le contenu d'un panier
	* @return panier Le panier et ses prix (unitaire et par lot)
	*
	**/
    public function contenuPanier()
    {
        foreach($this->panier as &$item)
        {
            $item["prixLot"] = $this->prixLot($item["pneu"]->reference);
            $item["prixUnitaire"] = $this->prixUnitaire($item["pneu"]->reference);
        }

        return $this->panier;
    }

	/**
	*  
	* @brief Récupère la quantité du panier
	* @return int|boolean quantité La quantité du panier, false si la quantité ne peut pas être récupéré
	*
	**/
    public function getQuantite($reference)
    {
        $item = &$this->getArticle($reference);

        if (isset($item))
            return $item["quantite"];
        else
            return false;
    }

	/**
	*  
	* @brief Vérifie la présence d'un pneu
	* @param string reference Référence du pneu dont on veut vérifier la présence
	* @return boolean|boolean true si le pneu est présent, false sinon
	*
	**/
    public function estPresent($reference)
    {
        $item = &$this->getArticle($reference);

        if (isset($item))
            return true;
        else
            return false;
    }

	/**
	*  
	* @brief Récupère un article par sa référence dans le panier
	* @param string reference Référence du pneu que l'on veut récupérer
	* @return Pneu pneu que l'on récupère
	*
	**/
    protected function &getArticle($reference)
    {
        $panier = &$this->panier;

        foreach ($panier as $key=>$item)
        {
            if ($item["pneu"]->reference == $reference)
                return $panier[$key];
        }

        $default = null;
        return $default;
    }

    protected $panier;
}