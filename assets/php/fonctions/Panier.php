<?php

include_once "Pneu.php";
include_once "../../../secret/credentials.php";

class Panier
{
    public function Panier()
    {
        $this->panier = array();
        $this->ratioPrix = SQLGetChamp("SELECT config_ratio_prix FROM jspneus.config");
    }

    public function vider()
    {
        $this->panier = array();
    }

    public function nbArticles()
    {
        return count($this->panier);
    }

    public function ajouterArticle($pneu, $quantite)
    {
        if (get_class($pneu) != Pneu::class || $quantite < 1)
            return false;

        if (!$this->getArticle($pneu->reference))
        {
            array_push($this->panier, array("pneu" => $pneu, "quantite" => $quantite));
            return true;
        }
        else
        {
            $this->ajouterQuantite($pneu->reference, $quantite);
            return true;
        }
    }

    public function retirerArticle($reference)
    {
        if ($this->getArticle($reference))
        {
            foreach ($this->panier as $key => $item)
            {
                if ($item["pneu"]->reference == $reference)
                {
                    unset($this->panier[$key]);
                    return true;
                }
            }
        }

        return false;
    }

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

    public function prixArticle($reference)
    {
        $item = &$this->getArticle($reference);
        if (isset($item))
        {
            return $item["pneu"]->prix * $this->ratioPrix * $item["quantite"];
        }
        else
            return false;
    }

    public function prixTotal()
    {
        $total = 0;

        foreach ($this->panier as $item)
        {
            $total += $this->prixArticle($item["pneu"]->reference);
        }

        return $total;
    }

    public function contenuPanier()
    {
        foreach($this->panier as &$item)
        {
            $item["prixLot"] = $this->prixArticle($item["pneu"]->reference);
        }

        return $this->panier;
    }

    public function getQuantite($reference)
    {
        $item = &$this->getArticle($reference);

        if (isset($item))
            return $item["quantite"];
        else
            return false;
    }

    public function estPresent($reference)
    {
        $item = &$this->getArticle($reference);

        if (isset($item))
            return true;
        else
            return false;
    }

    protected function &getArticle($reference)
    {
        $panier = &$this->panier;

        foreach ($panier as $key=>$item)
        {
            if ($item["pneu"]->reference == $reference)
                return $panier[$key];
        }

        $null = null;
        return $null;
    }

    protected $panier;
    protected $ratioPrix;
}