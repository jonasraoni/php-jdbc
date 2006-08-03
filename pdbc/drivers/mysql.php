<?php
define('PDBC_MYSQL_DRIVER', PDBC_DRIVERS . 'mysql/');
require_once PDBC_MYSQL_DRIVER . 'driver.php';

/* Registers the MySQL driver into the DriverManager driver's list */
DriverManager::registerDriver(new MySQLDriver);
?>