<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: batch-update-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLException thrown when an error occurs during a batch update operation
*/

require_once PDBC_EXCEPTIONS . 'sql-exception.php';

class BatchUpdateException extends SQLException{
	var $_updateCounts = array();

	/**
	* Class constructor
	* @param Integer[] $updateCounts
	* @param String $message
	* @param String $sqlState
	* @param Integer $vendorCode
	*/
	function BatchUpdateException($updateCounts = array(), $message = '', $sqlState = '', $vendorCode = 0){
		parent::SQLException($message, $sqlState, $vendorCode);
		$this->_updateCounts = $updateCounts;
	}

	/**
	* Retrieves the update count for each update statement in the batch update that executed successfully before this exception occurred
	* @return Integer[]
	*/
	function getUpdateCounts(){
		return $this->_updateCounts;
	}
}
?>