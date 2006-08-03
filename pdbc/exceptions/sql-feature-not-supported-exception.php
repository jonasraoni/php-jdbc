<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-feature-not-supported-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLException thrown when the SQLState class value is 'OA'. This indicates that the JDBC driver does not support a given feature
*/

require_once PDBC_EXCEPTIONS . 'sql-non-transient-exception.php';

class SQLFeatureNotSupportedException extends SQLNonTransientException{
	/**
	* Class constructor
	* @param Array $failedProperties
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function SQLFeatureNotSupportedException($message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLNonTransientException($message, $sqlState, $vendorCode);
	}
}
?>