<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-warning.php,v 1.0 2006/05/20 18:58:07
* @abstract An exception that provides information on database access warnings
*/

require_once PDBC_EXCEPTIONS . 'sql-exception.php';

class SQLWarning extends SQLException{
	/**
	* Class constructor
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function SQLWarning($message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLException($message, $sqlState, $vendorCode);
	}

	/**
	* Retrieves the warning chained to this SQLWarning object by setNextWarning
	* @return SQLWarning
	*/
	function &getNextWarning(){
		$warning = &$this->getNextException();
		return $warning;
	}

	/**
	* Adds a SQLWarning object to the end of the chain
	* @param SQLWarning $exception
	* @return void
	*/
	function setNextWarning(&$exception){
		$this->setNextException($exception);
	}
}
?>