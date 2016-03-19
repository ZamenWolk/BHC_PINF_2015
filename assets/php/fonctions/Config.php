<?php

class Config
{
    public static function getRatioPrix($ID = null)
    {
        if ($ID == null)
            return SQLGetChamp("SELECT config_ratio_prix FROM jspneus.config ORDER BY config_date DESC LIMIT 1");
        else
            return SQLGetChamp("SELECT config_ratio_prix FROM jspneus.config WHERE config_date<=? ORDER BY config_date DESC LIMIT 1", [$ID]);
    }
}