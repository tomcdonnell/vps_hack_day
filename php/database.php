<?php
/*
 * vim: ts=4 sw=4 et wrap co=100 go-=b
 */

// Includes. ///////////////////////////////////////////////////////////////////////////////////////

// Order important.
require_once dirname(__FILE__) . '/php_ini.php';
require_once dirname(__FILE__) . '/../lib_tom/php/database/DatabaseManager.php';

// Globally executed code. /////////////////////////////////////////////////////////////////////////

try
{
    DatabaseManager::add
    (
        array
        (
            'name'     => 'root'     ,
            'host'     => 'localhost',
            'user'     => 'tom'      ,
            'password' => 'igaiasma' ,
            'database' => 'vps_hack_day'
        )
    );
}
catch (Exception $e)
{
    echo $e->getMessage();
}
