<?php

namespace Bonnibel\Database;

class Env
{
    public static function load($dir)
    {
        if(!file_exists($dir.'/.env')){
            return false;
        }
        $lines = file($dir.'/.env');
        foreach($lines as $line){
            putenv(trim($line));
        }
    }
}