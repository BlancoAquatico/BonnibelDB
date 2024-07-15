<?php

include __DIR__.'/SimpleDb/DB/src/Database.php';
include __DIR__.'/SimpleDb/Env/src/Env.php';

use Bonnibel\Database\Database;
use Bonnibel\Database\Env;

Env::load(__DIR__);


    /**
     * Valores padão (Modificaveis)
     * @param string $dbName = null
     * @param string $host = 'localhost'
     * @param string $user = 'root'
     * @param string $password = ''
     * @param int $port = 3306
     */

$DB = new Database(getenv('DB_NAME'));


/**
 * Summary of getDbname
 * @return string
 */
$DB->getDbname();

/**
 * Summary of getHost
 * @return string
 */
$DB->getHost();

/**
 * Summary of getPassword
 * @return string
 */
$DB->getPassword();

/**
 * Summary of getPort
 * @return string
 */
$DB->getPort();

/**
 * Summary of getUser
 * @return string
 */
$DB->getUser();

$DB->viewSelect('itens', 'WHERE id = 2');