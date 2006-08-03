<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-invalid-authorization-spec-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLException thrown when the SQLState class value is '28'. This indicated that the authorization credentials presented during connection establishment are not valid
*/

require_once PDBC_EXCEPTIONS . 'sql-non-transient-exception.php';

class SQLInvalidAuthorizationSpecException extends SQLNonTransientException{
	/**
	* Class constructor
	* @param Array $failedProperties
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function SQLInvalidAuthorizationSpecException($message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLNonTransientException($message, $sqlState, $vendorCode);
	}
}
?>