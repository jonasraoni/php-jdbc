<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: client-info-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLException is thrown when one or more client info properties could not be set on a Connection
*/

require_once PDBC_EXCEPTIONS . 'sql-exception.php';

class ClientInfoException extends SQLException{
	var $_failedProperties = array();

	/**
	* Class constructor
	* @param Array $failedProperties
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function ClientInfoException($failedProperties = array(), $message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLException($message, $sqlState, $vendorCode);
		$this->_failedProperties = $failedProperties;
	}

	/**
	* Returns the list of client info properties that could not be set
	* @return Array
	*/
	function getFailedProperties(){
		return $this->_failedProperties;
	}
}
?>