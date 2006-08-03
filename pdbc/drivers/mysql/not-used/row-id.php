<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: row-id.php,v 1.0 2006/05/09 18:58:07
* @abstract MySQLRowId
*/

require_once PDBC_INTERFACES . 'row-id.php';

class MySQLRowId extends RowId{
	/**
	* Compares this RowId to the specified object
	* @param Object $obj
	* @return Boolean
	*/
	function equals($obj){
		die('Not implemented');
	}

	/**
	* Returns an array of bytes representing the value of the SQL ROWID designated by this java.sql.RowId object
	* @return Integer[]
	*/
	function getBytes(){
		die('Not implemented');
	}

	/**
	* Returns a hash code value of this RowId object
	* @return Integer
	*/
	function hashCode(){
		die('Not implemented');
	}

	/**
	*  Returns a String representing the value of the SQL ROWID designated by this java.sql.RowId object
	* @return String
	*/
	function toString(){
		die('Not implemented');
	}
}
?>