<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: data-truncation.php,v 1.0 2006/05/20 18:58:07
* @abstract An exception thrown as a DataTruncation exception (on writes) or reported as a DataTruncation warning (on reads) when a data values is unexpectedly truncated for reasons other than its having execeeded MaxFieldSize
*/

require_once PDBC_EXCEPTIONS . 'sql-warning.php';

class DataTruncation extends SQLWarning{
	var $_index;
	var $_parameter;
	var $_read;
	var $_dataSize;
	var $_transferSize;

	/**
	* Class constructor
	* @param Integer $index
	* @param Boolean $parameter
	* @param Boolean $read
	* @param Integer $dataSize
	* @param Integer $transferSize
	* @param String $message
	*/
	function DataTruncation($index, $parameter, $read, $dataSize, $transferSize, $message = ''){
		parent::SQLWarning($message);
		$this->_index = $index;
		$this->_parameter = $parameter;
		$this->_read = $read;
		$this->_dataSize = $dataSize;
		$this->_transferSize = $transferSize;
	}

	/**
	* Retrieves the index of the column or parameter that was truncated
	* @return Integer
	*/
	function &getIndex(){
		return $this->_index;
	}

	/**
	* Indicates whether the value truncated was a parameter value or a column value
	* @return Boolean
	*/
	function &getParameter(){
		return $this->_parameter;
	}

	/**
	* Retrieves the index of the column or parameter that was truncated
	* @return Boolean
	*/
	function &getRead(){
		return $this->_read;
	}

	/**
	* Gets the number of bytes of data that should have been transferred
	* @return Integer
	*/
	function &getDataSize(){
		return $this->_dataSize;
	}

	/**
	* Gets the number of bytes of data actually transferred
	* @return Integer
	*/
	function &getTransferSize(){
		return $this->_transferSize;
	}
}
?>