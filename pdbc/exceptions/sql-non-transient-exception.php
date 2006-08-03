<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-non-transient-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLException thrown when an instance where a retry of the same operation would fail unless the cause of the SQLException  is corrected
*/

require_once PDBC_EXCEPTIONS . 'sql-exception.php';

class SQLNonTransientException extends SQLException{
	/**
	* Class constructor
	* @param Array $failedProperties
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function SQLNonTransientException($message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLException($message, $sqlState, $vendorCode);
	}
}
?>