<?php

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
    
    public static function getLastConfigDate()
    {
        return SQLGetChamp("SELECT config_date FROM config ORDER BY config_date DESC LIMIT 1");
    }
}