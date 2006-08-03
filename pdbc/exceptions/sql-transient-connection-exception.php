<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-transient-connection-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLException for the SQLState class value '08', representing that the connection operation that failed might be able to succeed when the operation is retried without any application-level changes
*/

require_once PDBC_EXCEPTIONS . 'sql-transient-exception.php';

class SQLTransientConnectionException extends SQLTransientException{
	/**
	* Class constructor
	* @param Array $failedProperties
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function SQLTransientConnectionException($message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLTransientException($message, $sqlState, $vendorCode);
	}
}
?>