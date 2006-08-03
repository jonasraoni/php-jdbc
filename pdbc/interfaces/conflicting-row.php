<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: conflicting-row.php,v 1.0 2006/05/09 18:58:07
* @abstract A ConflictingRow object is obtained by iterating over a DataSetResolver object. Each ConflictingRow object represents a row whose update could not be propagated to the underlying data store by an invocation of the method DataSet.sync
*/

class ConflictingRow{
	/**
	* Class constructor
	* @param Object $row
	* @param SQLException $exception
	*/
	function &ConflictingRow(&$row, &$exception){
		die('Not implemented');
	}

	/**
	* Retrieves an object representing a row within the DataSet which could not be successfully updated in the underlying data source
	* @return Row
	*/
	function &getRow(){
		die('Not implemented');
	}

	/**
	* Retrieves the SQLException object that resulted during the update to the underlying data source for the given row
	* @return SQLException
	*/
	function &getSQLException(){
		die('Not implemented');
	}
}
?>