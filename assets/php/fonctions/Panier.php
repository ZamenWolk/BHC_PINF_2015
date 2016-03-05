<?php

include_once "Pneu.php";

class Panier
{
    public function Panier($ratioPrix)
    {
        if ($ratioPrix <= 0)
            $ratioPrix = 1;
        $this->panier = array();
        $this->ratioPrix = $ratioPrix;
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
                    return;
                }
            }
        }
    }

    public function ajouterQuantite($reference, $quantite)
    {
        if (!$this->getArticle($reference) || $quantite < 0)
            return false;
        else
        {
            $item = &$this->getArticle($reference);
            $item["pneu"]->quantite += $quantite;
            return $item["pneu"]->quantite;
        }
    }

    public function retirerQuantite($reference, $quantite)
    {
        if (!$this->getArticle($reference) || $quantite < 0)
            return 0;
        else
        {
            $item = &$this->getArticle($reference);
            if ($item["pneu"]->quantite - $quantite < 0)
                return false;
            else if ($item["pneu"]->quantite == $quantite)
            {
                $this->retirerArticle($reference);
                return 0;
            }
            else
            {
                $item["pneu"]->quantite -= $quantite;
                return $item["pneu"]->quantite;
            }
        }
    }

    public function prixArticle($reference)
    {
        $item = &$this->getArticle($reference);
        if (!$item)
            return false;
        else
            return $item["pneu"]->prix * $this->ratioPrix * $item["quantite"];
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
        return $this->panier;
    }

    protected function &getArticle($reference)
    {
        $panier = &$this->panier;

        foreach ($panier as $item)
        {
            if ($item["pneu"]->reference == $reference)
                return $item;
        }

        return false;
    }

    protected $panier;
    protected $ratioPrix;
}