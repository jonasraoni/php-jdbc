<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: conflicting-row.php,v 1.0 2006/05/09 18:58:07
* @abstract MySQLConflictingRow
*/

require_once PDBC_INTERFACES . 'conflicting-row.php';

class MySQLConflictingRow extends ConflictingRow{
	var $_exception = null;
	var $_row = null;

	/**
	* Class constructor
	* @param Object $row
	* @param SQLException $exception
	*/
	function &ConflictingRow(&$row, &$exception){
		$this->_row = &$row;
		$this->_exception = &$exception;
		return $this;
	}

	/**
	* Retrieves an object representing a row within the DataSet which could not be successfully updated in the underlying data source
	* @return Row
	*/
	function &getRow(){
		return $this->_row;
	}

	/**
	* Retrieves the SQLException object that resulted during the update to the underlying data source for the given row
	* @return SQLException
	*/
	function &getSQLException(){
		return $this->_exception
	}
}
?>