<?php

/**
 * @file maLibSQL.php
 * Ce fichier définit les fonctions de requêtage
 * Il nécessite d'avoir défini les variables $BDD_login, $BDD_password $BDD_chaine dans config.php, qui est chargé au moment de l'appel de la librairie
 * @note Pour accélérer les traitements, les requêtes aux bases de données seront persistantes : on ne les fermera pas à chaque fin de requête. 
 * On utilise pour cela la fonction pconnect
 * @todo On pourrait tracer les requêtes dans une table de logs
 */

/**
 * Exécuter une requête UPDATE. Renvoie le nb de modifs ou faux si pb
 * On testera donc avec === pour différencier faux de 0 
 * @return int|false nombre d'enregistrements affectés, ou false si pb...
 * @param string $sql la requete a executer
 * @param array $param les parametres de la requete
 * @pre Les variables  $BDD_login, $BDD_password $BDD_chaine doivent exister
 */
function SQLUpdate($sql, $param = null)
{
	global $BDD_host;
	global $BDD_base;
	global $BDD_user;
	global $BDD_password;

	try {
		$dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base;charset=UTF8", $BDD_user, $BDD_password);
	} catch (PDOException $e) {
		die("<font color=\"red\">SQLUpdate/Delete: Erreur de connexion : " . $e->getMessage() . "</font>");
	}

	$req = $dbh->prepare($sql);

	if ($req->execute($param) === false) {
		$e = $req->errorInfo();
		die("<font color=\"red\">SQLUpdate/Delete: Erreur de requete : " . $e[2] . "</font>");
	}

	$dbh = null;
	$nb = $req->rowCount();
	$req->closeCursor();
	if ($nb != 0) return $nb;
	else return false;
	
}

// Un delete c'est comme un Update
function SQLDelete($sql, $param = null) {return SQLUpdate($sql, $param);}


/**
 * Exécuter une requête INSERT 
 * @param string $sql requete a executer
 * @param array $param parametres de la requete
 * @pre Les variables  $BDD_login, $BDD_password $BDD_chaine doivent exister
 * @return int Renvoie l'insert ID ... utile quand c'est un numéro auto
 */
function SQLInsert($sql, $param = null)
{
	global $BDD_host;
	global $BDD_base;
	global $BDD_user;
	global $BDD_password;
	
	try {
		$dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base;charset=UTF8", $BDD_user, $BDD_password);
	} catch (PDOException $e) {
		die("<font color=\"red\">SQLInsert: Erreur de connexion : " . $e->getMessage() . "</font>");
	}

	$req = $dbh->prepare($sql);

	if ($req->execute($param) === false) {
		$e = $req->errorInfo();
		die("<font color=\"red\">SQLInsert: Erreur de requete : " . $e[2] . "</font>");
	}

	$lastInsertId = $dbh->lastInsertId();
	$dbh = null;
	$req->closeCursor();
	return $lastInsertId;
}



/**
* Effectue une requete SELECT dans une base de données SQL SERVER, pour récupérer uniquement un champ (la requete ne doit donc porter que sur une valeur)
* Renvoie FALSE si pas de resultats, ou la valeur du champ sinon
* @pre Les variables  $BDD_login, $BDD_password $BDD_chaine doivent exister
* @param string $sql requete à executer
* @param array $param parametres de la requete
* @return false|string
*/
function SQLGetChamp($sql, $param = null)
{
	global $BDD_host;
	global $BDD_base;
	global $BDD_user;
	global $BDD_password;

	try {
		$dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base;charset=UTF8", $BDD_user, $BDD_password);
	} catch (PDOException $e) {
		die("<font color=\"red\">SQLGetChamp: Erreur de connexion : " . $e->getMessage() . "</font>");
	}

	$req = $dbh->prepare($sql);

	if ($req->execute($param) === false) {
		$e = $req->errorInfo();
		die("<font color=\"red\">SQLGetChamp: Erreur de requete : " . $e[2] . "</font>");
	}

	$num = $req->rowCount();
	$dbh = null;

	if ($num==0) return false;

	$ligne = $req->fetch();
	$req->closeCursor();
	if ($ligne == false) return false;
	else return $ligne[0];

}

/**
 * Effectue une requete SELECT dans une base de données SQL SERVER
 * Renvoie FALSE si pas de resultats, ou la ressource sinon
 * @pre Les variables  $BDD_login, $BDD_password $BDD_chaine doivent exister
 * @param string $SQL
 * @return boolean|array
 */
function SQLSelect($sql, $param = null)
{
	global $BDD_host;
	global $BDD_base;
	global $BDD_user;
	global $BDD_password;

	try {
		$dbh = new PDO("mysql:host=$BDD_host;dbname=$BDD_base;charset=UTF8", $BDD_user, $BDD_password);
	} catch (PDOException $e) {
		die("<font color=\"red\">SQLSelect: Erreur de connexion : " . $e->getMessage() . "</font>");
	}

	$dbh->exec("SET CHARACTER SET utf8");

	$req = $dbh->prepare($sql);

	if ($req->execute($param) === false) {
		$e = $req->errorInfo();
		die("<font color=\"red\">SQLSelect: Erreur de requete : " . $e[2] . "</font>");
	}

	$num = $req->rowCount();
	$dbh = null;
	if ($num != 0)
		$data = $req->fetchAll();
	$req->closeCursor();
	if ($num==0) return false;
	else return $data;
}

/**
*
* Parcours les enregistrements d'un résultat mysql et les renvoie sous forme de tableau associatif
* On peut ensuite l'afficher avec la fonction print_r, ou le parcourir avec foreach
* @param resultat_Mysql $result
*/
function parcoursRs($result)
{
	if  ($result == false) return array();

	$result->setFetchMode(PDO::FETCH_ASSOC);
	while ($ligne = $result->fetch()) 
		$tab[]= $ligne;

	return $tab;
}










?>
