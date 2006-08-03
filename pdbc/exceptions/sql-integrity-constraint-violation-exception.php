<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-integrity-constraint-violation-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLException thrown when the SQLState class value is '23'. This indicates that an integrity constraint (foreign key, primary key or unique key) has been violated
*/

require_once PDBC_EXCEPTIONS . 'sql-non-transient-exception.php';

class SQLIntegrityConstraintViolationException extends SQLNonTransientException{
	/**
	* Class constructor
	* @param Array $failedProperties
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function SQLIntegrityConstraintViolationException($message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLNonTransientException($message, $sqlState, $vendorCode);
	}
}
?>