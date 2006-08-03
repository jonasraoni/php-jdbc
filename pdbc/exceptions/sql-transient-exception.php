<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-non-transient-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLException is thrown in situations where a previoulsy failed operation might be able to succeed when the operation is retried without any intervention by application-level functionality
*/

require_once PDBC_EXCEPTIONS . 'sql-exception.php';

class SQLTransientException extends SQLException{
	/**
	* Class constructor
	* @param Array $failedProperties
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function SQLTransientException($message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLException($message, $sqlState, $vendorCode);
	}
}
?>