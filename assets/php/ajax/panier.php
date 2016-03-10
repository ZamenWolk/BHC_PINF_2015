<?php
include_once("../fonctions/AJAX.php");
include_once("../fonctions/Panier.php");

session_start();

if (!isset($_SESSION["panier"]))
    $_SESSION["panier"] = new Panier();

$panier = $_SESSION["panier"];

/**
 * Fichier utiliant la méthode "POST"
 * Actions possibles :
 *
 * "vider"
 * Vide le panier
 * Aucun argument
 * Renvoi :
 *      ["vide" => true]
 * Ne peut échouer
 *
 *
 * "nbArticles"
 * Permet d'obtenir le nombre d'articles dans le panier
 * Aucun argument
 * Renvoi :
 * [    "nbArticles" => nombre d'articles ]
 * Ne peut échouer
 *
 *
 * "ajouterArticle"
 * Ajoute le pneu valable associé à une référence dans le panier
 * Arguments :
 * [    "referencePneu" => référence du pneu à ajouter,
 *      "quantite"      => quantité à ajouter au panier *optionnel, 1 par défaut* ]
 * Renvoi :
 * [    "panier"    => contenu du panier,
 *      "prixTotal" => prix total du panier ]
 * Echoue si :
 *      - La référence du pneu n'est pas définie
 *      - La quantité à ajouter est inferieure à 1
 *      - La référence n'existe pas
 *      - la variable passée à Panier::ajouterArticle n'est pas une instance de Pneu (ne devrait pas arriver)
 *
 *
 * "retirerArticle"
 * Retire le pneu associé à une référence dans le panier
 * Arguments :
 * [    "referencePneu" => référence du pneu à retirer ]
 * Renvoi :
 * [    "panier"    => contenu du panier,
 *      "prixTotal" => prix total du produit ]
 * Avertit si :
 *      - La référence du pneu n'était pas présente dans le panier avant la suppression
 * Echoue si :
 *      - La référence du pneu n'est pas définie
 *
 *
 * "ajouterQuantite"
 * Ajoute une quantité à un pneu présent dans le panier
 * Arguments :
 * [    "referencePneu" => référence du pneu à modifier,
 *      "quantite"      => quantité à ajouter au panier *optionnel, 1 par défaut* ]
 * Renvoi :
 * [    "panier"    => contenu du panier,
 *      "prixTotal" => prix total du produit ]
 * Avertit si :
 *      - Le stock en BDD est inferieur à la quantité voulue. Dans ce cas, la nouvelle quantité est celle en BDD
 * Echoue si :
 *      - La référence du pneu n'est pas définie
 *      - La quantité à ajouter est inferieure à 1
 *      - La référence du pneu n'est pas présente dans le panier
 *
 *
 * "retirerQuantite"
 * Retire une quantité à un pneu présent dans le panier
 * Arguments :
 * [    "referencePneu" => référence du pneu à modifier,
 *      "quantite"      => quantité à retirer au panier *optionnel, 1 par défaut* ]
 * Renvoi :
 * [    "panier"    => contenu du panier,
 *      "prixTotal" => prix total du produit ]
 * Echoue si :
 *      - La référence du pneu n'est pas définie
 *      - La quantité à retirer est inferieure à 1
 *      - La référence du pneu n'est pas présente dans le panier
 *      - La quantité à retirer est superieure à la quantité dans le panier
 *
 *
 * "changerQuantite"
 * Change la quantité d'un pneu présent dans le panier
 * Arguments :
 * [    "referencePneu" => référence du pneu à modifier,
 *      "quantite"      => Nouvelle quantité du pneu *optionnel, 1 par défaut* ]
 * Renvoi :
 * [    "panier"    => contenu du panier,
 *      "prixTotal" => prix total du produit ]
 * Avertit si :
 *      - Le stock en BDD est inferieur à la quantité voulue. Dans ce cas, la nouvelle quantité est le stock en BDD
 * Echoue si :
 *      - La référence du pneu n'est pas définie
 *      - La nouvelle quantité est inferieure à 0
 *      - La référence du pneu n'est pas présente dans le panier
 *
 *
 * "prixLot"
 * Permet d'obtenir le prix du lot de pneu identifié par une référence
 * Arguments :
 * [    "referencePneu" => référence du pneu ]
 * Renvoi :
 * [    "referencePneu" => référence du pneu,
 *      "prixLot"       => prix du lot ]
 * Echoue si :
 *      - La référence du pneu n'est pas définie
 *
 *
 * "contenuPanier"
 * Permet d'obtenir le contenu du panier
 * Aucun argument
 * Renvoi :
 * [    "panier"    => contenu du panier,
 *      "prixTotal" => prix total du produit ]
 */

if (!isset($_POST["action"]))
{
    ajaxError("Action non définie");
}

$action = $_POST["action"];

switch ($action)
{
    case "vider":

        $panier->vider();
        ajaxSuccess(["vide" => true]);

        break;

    case "nbArticles":

        ajaxSuccess(["nbArticles" => $panier->nbArticles()]);

        break;

    case "ajouterArticle":

        if (!isset($_POST["referencePneu"]))
            ajaxError('$_POST["referencePneu"] est vide');

        $referencePneu = $_POST["referencePneu"];
        $quantite = isset($_POST["quantite"]) ? $_POST["quantite"] : 1;

        if ($quantite < 1)
            ajaxError('La quantité à ajouter est negative ou nulle');

        $pneu = Pneu::getPneuFromDB($referencePneu);

        if ($pneu === false)
            ajaxError("Cette référence n'existe pas");

        $result = $panier->ajouterArticle($pneu, $quantite);

        if ($result === false)
            ajaxError("Erreur du fichier ajax, veuillez contacter l'administrateur réseau");

        ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);

        break;

    case "retirerArticle":

        if (!isset($_POST["referencePneu"]))
            ajaxError('$_POST["referencePneu"] est vide');

        $referencePneu = $_POST["referencePneu"];

        $result = $panier->retirerArticle($referencePneu);

        if ($result)
            ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);
        else
            ajaxWarning("La référence n'était pas présente dans le panier", ["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);

        break;

    case "ajouterQuantite":

        if (!isset($_POST["referencePneu"]))
            ajaxError('$_POST["referencePneu"] est vide');

        $referencePneu = $_POST["referencePneu"];
        $quantite = isset($_POST["quantite"]) ? $_POST["quantite"] : 1;

        if ($quantite < 1)
            ajaxError('La quantité à ajouter est inférieure à 1');

        $qtActuel = $panier->getQuantite($referencePneu);

        $result = $panier->ajouterQuantite($referencePneu, $quantite);

        if ($result)
            ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);
        else if (!$panier->estPresent($referencePneu))
            ajaxError("La référence n'est pas présente dans le panier");
        else
            ajaxWarning("Le stock était inferieur à la quantité voulue, la quantité à été modifiée à la valeur du stock", ["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);

        break;

    case "retirerQuantite":

        if (!isset($_POST["referencePneu"]))
            ajaxError('$_POST["referencePneu"] est vide');

        $referencePneu = $_POST["referencePneu"];
        $quantite = isset($_POST["quantite"]) ? $_POST["quantite"] : 1;

        if ($quantite < 1)
            ajaxError('La quantité à ajouter est inférieure à 1');

        $result = $panier->retirerQuantite($referencePneu, $quantite);

        if ($result)
            ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);
        else
        {
            if (!$panier->estPresent($referencePneu))
                ajaxError("La référence n'est pas présente dans le panier");
            else
                ajaxError("La quantité à retirer est superieure à la quantité dans le panier");
        }

        break;

    case "changerQuantite":

        if (!isset($_POST["referencePneu"]))
            ajaxError('$_POST["referencePneu"] est vide');

        $referencePneu = $_POST["referencePneu"];
        $quantite = isset($_POST["quantite"]) ? $_POST["quantite"] : 1;

        if ($quantite < 0)
            ajaxError('La nouvelle quantité est negative');

        $result = $panier->changerQuantite($referencePneu, $quantite);

        if ($result === false)
            ajaxError("La référence n'est pas présente dans le panier");
        else if ($result != $quantite)
            ajaxWarning("Le stock était inferieur à la quantité voulue, la quantité à été modifiée à la valeur du stock", ["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);
        else
            ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);

        break;

    case "prixLot":

        if (!isset($_POST["referencePneu"]))
            ajaxError("La référence du pneu n'est pas définie");

        $referencePneu = $_POST["referencePneu"];

        ajaxSuccess(["referencePneu" => $referencePneu, "prixLot" => $panier->prixLot($referencePneu)]);

        break;

    case "contenuPanier":

        ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);

        break;

    default :
        ajaxError("Action inconnue");
}