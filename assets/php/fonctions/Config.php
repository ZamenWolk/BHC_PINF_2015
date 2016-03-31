<?php
/**
	*  
	* @brief récupère le ratio de prix lié à la marge de bénéfice de l'entreprise, l'ID sert à récupérer un coefficient à une date particulière si on veut appliquer le coefficient à une commande ultérieure que l'on repère par un ID
	* @param int ID si on veut un coefficient de prix particulier
	* @return float|boolean ratio que l'on voulait récupérer, false si SQLGetChamp ne réussit pas à récupérer un coefficient
	*
	**/
class Config
{
    public static function getRatioPrix($ID = null)
    {
        if ($ID == null)
            return SQLGetChamp("SELECT config_ratio_prix FROM config ORDER BY config_date DESC LIMIT 1");
        else
            return SQLGetChamp("SELECT config_ratio_prix FROM config WHERE config_date<=? ORDER BY config_date DESC LIMIT 1", [$ID]);
    }
    
    public static function setRatioPrix($newRatio)
    {
        return SQLInsert("INSERT INTO config (config_date, config_ratio_prix) VALUES (". time() .", $newRatio)");
    }
}