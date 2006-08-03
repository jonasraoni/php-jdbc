<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: pdbc.php,v 1.0 2006/05/09 15:36:00
* @abstract The main PDBC file
*/

/* Base paths */
define('PDBC_BASE_DIR', dirname(__FILE__) . '/');
define('PDBC_CLASSES', PDBC_BASE_DIR . 'classes/');
define('PDBC_INTERFACES', PDBC_BASE_DIR . 'interfaces/');
define('PDBC_DRIVERS', PDBC_BASE_DIR . 'drivers/');
define('PDBC_EXCEPTIONS', PDBC_BASE_DIR . 'exceptions/');

/* PHP 4 fixes */
require_once PDBC_BASE_DIR . 'const.php';

/* Poor exception handler for PHP 4 */
require_once PDBC_BASE_DIR . 'php4-exception-handler.php';
/* If true, instead of leaving exceptions waiting for a "catch", it dies */
define('ON_EXCEPTION_DIE', false);

/* Base classes */
require_once PDBC_CLASSES . 'print-writer.php';
require_once PDBC_CLASSES . 'driver-manager.php';
require_once PDBC_EXCEPTIONS . 'sql-warning.php';
?>