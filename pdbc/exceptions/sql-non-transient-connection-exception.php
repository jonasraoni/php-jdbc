<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-non-transient-connection-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLException thrown for the SQLState class value '08', representing that the connection operation that failed will not succeed when the operation is retried without the cause of the failure being corrected
*/

require_once PDBC_EXCEPTIONS . 'sql-non-transient-exception.php';

class SQLNonTransientConnectionException extends SQLNonTransientException{
	/**
	* Class constructor
	* @param Array $failedProperties
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function SQLNonTransientConnectionException($message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLNonTransientException($message, $sqlState, $vendorCode);
	}
}
?>