<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract An exception that provides information on a database access error or other errors
*/

class SQLException extends Exception{
	var $_sqlState = '';
	var $_vendorCode = 0;
	var $_fistException = null;
	var $_lastException = null;

	/**
	* Class constructor
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function SQLException($message = '', $sqlState = '', $vendorCode = 0){
		parent::__construct($message);
		$this->_sqlState = $sqlState;
		$this->_vendorCode = $vendorCode;
	}

	/**
	* Retrieves the SQLState for this SQLException object
	* @return String
	*/
	function getSQLState(){
		return $this->_sqlState;
	}

	/**
	* Retrieves the vendor-specific exception code for this SQLException object
	* @return Integer
	*/
	function getErrorCode(){
		return $this->_vendorCode;
	}

	/**
	* Retrieves the exception chained to this SQLException object by setNextException
	* @return SQLException
	*/
	function &getNextException(){
		return $this->_fistException;
	}

	/**
	* Adds an SQLException object to the end of the chain
	* @param SQLException $exception
	* @return void
	*/
	function setNextException(&$exception){
		if(!$this->_fistException)
			$this->_fistException = &$exception;
		else
			$this->_lastException->setNextException($exception);
		$this->_lastException = &$exception;
		return $this->_lastException;
	}
}
?>