<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-syntax-error-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLException thrown when the SQLState class value is '42'. This indicates that the in-progress query has violated SQL syntax rules
*/

require_once PDBC_EXCEPTIONS . 'sql-non-transient-exception.php';

class SQLSyntaxErrorException extends SQLNonTransientException{
	/**
	* Class constructor
	* @param Array $failedProperties
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function SQLSyntaxErrorException($message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLNonTransientException($message, $sqlState, $vendorCode);
	}
}
?>