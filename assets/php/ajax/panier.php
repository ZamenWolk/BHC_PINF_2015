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
 *      - La référence du pneu n'est pas définie                                                              (code MISSING_ARGUMENT)
 *      - La quantité à ajouter est inferieure à 1                                                            (code INVALID_QUANTITY)
 *      - La référence n'existe pas                                                                           (code UNKNOWN_REFERENCE)
 *      - la variable passée à Panier::ajouterArticle n'est pas une instance de Pneu (ne devrait pas arriver) (code INTERN_ERROR)
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
 *      - La référence du pneu n'était pas présente dans le panier avant la suppression (code MISSING_ARGUMENT)
 * Echoue si :
 *      - La référence du pneu n'est pas définie                                        (code NOT_IN_CART)
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
 *      - Le stock en BDD est inferieur à la quantité voulue. Dans ce cas, la nouvelle quantité est celle en BDD (code NOT_ENOUGH_STOCK)
 * Echoue si :
 *      - La référence du pneu n'est pas définie                                                                 (code MISSING_ARGUMENT)
 *      - La quantité à ajouter est inferieure à 1                                                               (code INVALID_QUANTITY)
 *      - La référence du pneu n'est pas présente dans le panier                                                 (code NOT_IN_CART)
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
 *      - La référence du pneu n'est pas définie                            (code MISSING_ARGUMENT)
 *      - La quantité à retirer est inferieure à 1                          (code INVALID_QUANTITY)
 *      - La référence du pneu n'est pas présente dans le panier            (code NOT_IN_CART)
 *      - La quantité à retirer est superieure à la quantité dans le panier (code CANT_TAKE_AWAY_ENOUGH)
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
 *      - Le stock en BDD est inferieur à la quantité voulue. Dans ce cas, la nouvelle quantité est le stock en BDD (code NOT_ENOUGH_STOCK)
 * Echoue si :
 *      - La référence du pneu n'est pas définie                                                                    (code MISSING_ARGUMENT)
 *      - La nouvelle quantité est inferieure à 0                                                                   (code INVALID_QUANTITY)
 *      - La référence du pneu n'est pas présente dans le panier                                                    (code NOT_IN_CART)
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
 *      - La référence du pneu n'est pas définie (code MISSING_ARGUMENT)
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
    ajaxError("Action non définie", "UNDEFINED_ACTION");
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
            ajaxError('$_POST["referencePneu"] est vide', "MISSING_ARGUMENT");

        $referencePneu = $_POST["referencePneu"];
        $quantite = isset($_POST["quantite"]) ? $_POST["quantite"] : 1;

        if ($quantite < 1)
            ajaxError('La quantité à ajouter est negative ou nulle', "INVALID_QUANTITY");

        $pneu = Pneu::getPneuFromDB($referencePneu);

        if ($pneu === false)
            ajaxError("Cette référence n'existe pas", "UNKNOWN_REFERENCE");

        $result = $panier->ajouterArticle($pneu, $quantite);

        if ($result === false)
            ajaxError("Erreur interne, veuillez contacter l'administrateur réseau", "INTERN_ERROR");

        ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);

        break;

    case "retirerArticle":

        if (!isset($_POST["referencePneu"]))
            ajaxError('$_POST["referencePneu"] est vide', "MISSING_ARGUMENT");

        $referencePneu = $_POST["referencePneu"];

        $result = $panier->retirerArticle($referencePneu);

        if ($result)
            ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);
        else
            ajaxWarning("La référence n'était pas présente dans le panier", ["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()], "NOT_IN_CART");

        break;

    case "ajouterQuantite":

        if (!isset($_POST["referencePneu"]))
            ajaxError('$_POST["referencePneu"] est vide', "MISSING_ARGUMENT");

        $referencePneu = $_POST["referencePneu"];
        $quantite = isset($_POST["quantite"]) ? $_POST["quantite"] : 1;

        if ($quantite < 1)
            ajaxError('La quantité à ajouter est inférieure à 1', "INVALID_QUANTITY");

        $qtActuel = $panier->getQuantite($referencePneu);

        $result = $panier->ajouterQuantite($referencePneu, $quantite);

        if ($result)
            ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);
        else if (!$panier->estPresent($referencePneu))
            ajaxError("La référence n'est pas présente dans le panier", "NOT_IN_CART");
        else
            ajaxWarning("Le stock était inferieur à la quantité voulue, la quantité à été modifiée à la valeur du stock", ["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()], "NOT_ENOUGH_STOCK");

        break;

    case "retirerQuantite":

        if (!isset($_POST["referencePneu"]))
            ajaxError('$_POST["referencePneu"] est vide', "MISSING_ARGUMENT");

        $referencePneu = $_POST["referencePneu"];
        $quantite = isset($_POST["quantite"]) ? $_POST["quantite"] : 1;

        if ($quantite < 1)
            ajaxError('La quantité à retirer est inférieure à 1', "INVALID_QUANTITY");

        $result = $panier->retirerQuantite($referencePneu, $quantite);

        if ($result)
            ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);
        else
        {
            if (!$panier->estPresent($referencePneu))
                ajaxError("La référence n'est pas présente dans le panier", "NOT_IN_CART");
            else
                ajaxError("La quantité à retirer est superieure à la quantité dans le panier", "CANT_TAKE_AWAY_ENOUGH");
        }

        break;

    case "changerQuantite":

        if (!isset($_POST["referencePneu"]))
            ajaxError('$_POST["referencePneu"] est vide', "MISSING_ARGUMENT");

        $referencePneu = $_POST["referencePneu"];
        $quantite = isset($_POST["quantite"]) ? $_POST["quantite"] : 1;

        if ($quantite < 0)
            ajaxError('La nouvelle quantité est negative', "INVALID_QUANTITY");

        $result = $panier->changerQuantite($referencePneu, $quantite);

        if ($result === false)
            ajaxError("La référence n'est pas présente dans le panier", "NOT_IN_CART");
        else if ($result != $quantite)
            ajaxWarning("Le stock était inferieur à la quantité voulue, la quantité à été modifiée à la valeur du stock", ["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()], "NOT_ENOUGH_STOCK");
        else
            ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);

        break;

    case "prixLot":

        if (!isset($_POST["referencePneu"]))
            ajaxError("La référence du pneu n'est pas définie", "MISSING_ARGUMENT");

        $referencePneu = $_POST["referencePneu"];

        ajaxSuccess(["referencePneu" => $referencePneu, "prixLot" => $panier->prixLot($referencePneu)]);

        break;

    case "contenuPanier":

        ajaxSuccess(["panier" => $panier->contenuPanier(), "prixTotal" => $panier->prixTotal()]);

        break;

    default :
        ajaxError("Action inconnue", "UNKNOWN_ACTION");
}