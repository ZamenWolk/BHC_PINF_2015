<?php
include('config.php')
?>
<?php // LES FONCTIONS QUE L'ON POURRAIT UTILISER POUR LA GESTION DU PANIER 

session_start(); 

/* On vérifie l'existence du panier, sinon, on le crée */ 
if(!isset($_SESSION['panier'])) 
{ 
    /* Initialisation du panier */ 
    $_SESSION['panier'] = array(); 
    /* contenu du panier */ 
    $_SESSION['panier']['qte'] = array(); 
    $_SESSION['panier']['taille'] = array(); 
    $_SESSION['panier']['prix'] = array(); 
} 

/*Si le panier existe bien on pourra ajouter un article dedans

 * Ajout d'un article dans le panier. Vérifie d'abord que l'article n'est pas déjà dans le panier. 
 * Si l'article est absent, on l'ajoute. 
 * S'il est présent, on met à jour en modifiant la quantité (y compris si c'est la même). 
 * 
 * @param array $select variable tableau associatif contenant les valeurs de l'article 
 */ 
function ajout($select) 
{ 
    if(!verif_panier($select['id'])) 
    { 
        array_push($_SESSION['panier']['id_article'],$select['id']); 
        array_push($_SESSION['panier']['qte'],$select['qte']); 
        array_push($_SESSION['panier']['taille'],$select['taille']); 
        array_push($_SESSION['panier']['prix'],$select['prix']); 
    } 
    else 
    { 
        modif_qte($select['id'],$select['qte']); 
    } 
}  

/*Pour éviter les doublons dans le panier on fait une fonction de vérification de présence*/
function verif_panier($ref_article) 
{ 
    $estPresent = false; 
    /* On vérifie les numéros de références des articles et on compare avec l'article à vérifier */ 
    if( count($_SESSION['panier']['id_article']) > 0 && array_search($ref_article,$_SESSION['panier']['id_article']) !== false) 
    { 
        $estPresent = true; 
    } 
    return $estPresent; 
} 

/**  * Modifie la quantité d'un article dans le panier 

 * @param String $ref_article    Identifiant de l'article à modifier 
 * @param Int $qte               Nouvelle quantité à enregistrer 
 * @return Mixed                 Retourne VRAI si la modification a bien eu lieu, 
 *                               FAUX sinon, 
 *                               "absent" si l'article est absent du panier, 
 *                               "qte_ok" si la quantité n'est pas modifiée car déjà correctement enregistrée. 
 */ 
function modif_qte($ref_article, $qte) 
{ 
    /* On initialise la variable de retour */ 
    $ajoute = false; 
	/*Si l'article existe bien et que sa quantité soit différente de celle qu'on veut déjà ajouté*/
    if(nombre_article($ref_article) != false && $qte != nombre_article($ref_article)) 
    { 
        /* On compte le nombre d'articles différents dans le panier */ 
        $nb_articles = count($_SESSION['panier']['id_article']); 
        /* On parcoure le tableau de session pour modifier l'article précis. */ 
        for($i = 0; $i < $nb_articles; $i++) 
        { 
            if($ref_article == $_SESSION['panier']['id_article']) 
            { 
                $_SESSION['panier']['qte'] = $qte; 
                $ajoute = true; 
            } 
        } 
    } 
    else 
    { 
        /* L'article est absent du panier, donc on ne peut pas modifier la quantité 
         *  Ou le nombre est exactement le même et il est inutile de le modifier 
         * Si l'article est absent,on ne peut pas l'ajouter 
         * Si le nombre est le même, on ne fait pas de changement. On peut donc retourner un autre 
         * type de valeur pour indiquer une erreur qu'il faudra traiter à part lors du retour d'appel 
         */ 
        if(nombre_article($ref_article) != false) 
        { 
            $ajoute = "absent"; 
        } 
        if($qte != nombre_article($ref_article)) 
        { 
            $ajoute = "qte_ok"; 
        } 
    } 
    return $ajoute; 
} 


/**  * Supprimer un article du panier 
 * 
 * @param String     $ref_article numéro de référence de l'article à supprimer 
 * @return Mixed     Retourne TRUE si la suppression a bien été effectuée, 
 *                   FALSE sinon, "absent" si l'article était déjà retiré du panier 
 */ 
function supprim_article($ref_article) 
{ 
    $suppression = false; 
    /* On vérifie que l'article à supprimer est bien présent dans le panier */ 
    if(nombre_article($ref_article) != false) 
    { 
        /* création d'un panier de transition */ 
        $panier_tmp = array("id_article"=>array(),"qte"=>array(),"taille"=>array(),"prix"=>array()); 
        /* Comptage des articles du panier */ 
        $nb_articles = count($_SESSION['panier']['id_article']); 
        /* Transfert du panier dans le panier temporaire */ 
        for($i = 0; $i < $nb_articles; $i++) 
        { 
            /* On transfère tout sauf l'article à supprimer */ 
            if($_SESSION['panier']['id_article'][$i] != $ref_article) 
            { 
                array_push($panier_tmp['id_article'],$_SESSION['panier']['id_article'][$i]); 
                array_push($panier_tmp['qte'],$_SESSION['panier']['qte'][$i]); 
                array_push($panier_tmp['taille'],$_SESSION['panier']['taille'][$i]); 
                array_push($panier_tmp['prix'],$_SESSION['panier']['prix'][$i]); 
            } 
        } 
        /* Le transfert est terminé, on ré-initialise le panier */ 
        $_SESSION['panier'] = $panier_tmp; 
        /* Option : on peut maintenant supprimer notre panier temporaire: */ 
        unset($panier_tmp); 
        $suppression = true; 
    } 
    else 
    { 
        /* L'article n'est pas dans le panier, on pourrait renvoyer "true" puisque de toute façon, 
        * le but était de le supprimer. Mais on pourrait exploiter une autre valeur de retour
		* puisqu'à ce moment là on essayait de supprimer un panier absent
		*utile pour les tests */
        $suppression = "absent"; 
    } 
    return $suppression; 
} 

/*Compte le prix total du panier en cours
*/
function montant_panier() 
{ 
    $montant = 0; 
    /* Comptage des articles du panier */ 
    $nb_articles = count($_SESSION['panier']['id_article']); 
    /* Calcul du prix total*/
    for($i = 0; $i < $nb_articles; $i++) 
    { 
        $montant += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i]; 
    } 
    /* On retourne le résultat */ 
    return $montant; 
} 

/** 
 * Vider le panier 
 * 
 * @return Mixed    Retourne VRAI si l'exécution s'est correctement déroulée, Faux sinon et "inexistant" si 
 *                  le panier avait déjà été détruit ou n'avait jamais été créé. 
 */ 
function vider_panier() 
{ 
    $vide = false; 
    if(isset($_SESSION['panier'])) 
    { 
        unset($_SESSION['panier']); 
        if(!isset($_SESSION['panier'])) 
        { 
            $vide = true; 
        } 
    } 
    else 
    { 
        /* Le panier était déjà détruit, on renvoie une autre valeur exploitable au retour */ 
        $vide = "inexistant"; 
    } 
    return $vide; 
} 

/**  * Vérifie la quantité enregistrée d'un article dans le panier 
 * 
 * @param String $ref_article référence de l'article à vérifier 
 * @return Mixed Renvoie le nombre d'article s'il y en a, ou Faux si cet article est absent du panier 
 */ 
function nombre_article($ref_article) 
{ 
    /* On initialise la variable de retour */ 
    $nombre = false; 
    /* Comptage du panier */ 
    $nb_art = count($_SESSION['panier']['id_article']); 
    /* On parcoure le panier à la recherche de l'article pour vérifier sa quantité */ 
    for($i = 0; $i < $nb_art; $i++) 
    { 
        if($_SESSION['panier']['id_article'][$i] == $ref_article) 
        $nombre = $_SESSION['panier']['qte'][$i]; 
    } 
    return $nombre; 
} 
?> 




 ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style>
		</style>
        <title>Mon panier</title>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
    <body>
	<div class="container">
    <h1>Mon panier</h1>
  	<hr>
	</body>
</html>
