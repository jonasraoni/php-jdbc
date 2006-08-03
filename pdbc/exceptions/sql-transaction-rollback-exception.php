<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-transaction-rollback-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLException thrown when the SQLState class value is '40'. This indicates that the current statement was automatically rolled back by the database becuase of deadlock or other transaction serialization failures
*/

require_once PDBC_EXCEPTIONS . 'sql-transient-exception.php';

class SQLTransactionRollbackException extends SQLTransientException{
	/**
	* Class constructor
	* @param Array $failedProperties
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function SQLTransactionRollbackException($message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLTransientException($message, $sqlState, $vendorCode);
	}
}
?>