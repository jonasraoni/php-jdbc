<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-timeout-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLException thrown when the timeout specified by Statement  has expired
*/

require_once PDBC_EXCEPTIONS . 'sql-transient-exception.php';

class SQLTimeoutException extends SQLTransientException{
	/**
	* Class constructor
	* @param Array $failedProperties
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function SQLTimeoutException($message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLTransientException($message, $sqlState, $vendorCode);
	}
}
?>