<?php
/*
 * vim: ts=4 sw=4 et wrap co=100
 *
 * PHP INI settings to be used througout the project.  All PHP files should include this file.
 */

ini_set('display_errors'        , '1');
ini_set('display_startup_errors', '1');

error_reporting(-1);

set_include_path(dirname(__FILE__) . '/../library/'); // Required for Zend Framework.

date_default_timezone_set('Australia/Melbourne');
?>
