<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: array.php,v 1.0 2006/05/09 18:58:07
* @abstract The mapping for the SQL type ARRAY
*/

class Vector{
	/**
	* Class constructor
	* @param Array $data
	*/
	function &Vector($data = array()){


	}

	/**
	* Retrieves the SQL type name of the elements in the array designated by this Array object
	* @return String
	*/
	function getBaseTypeName(){
		die('Not implemented');
	}

	/**
	* Retrieves the JDBC type of the elements in the array designated by this Array object
	* @return Integer
	*/
	function getBaseType(){
		die('Not implemented');
	}

	/**
	* Retreives a slice of the SQL ARRAY value designated by this Array object, beginning with the specified index and containing up to count  successive elements of the SQL array
	* @param Integer $index
	* @param Integer $count
	* @param Map $map
	* @return Array
	*/
	function getArray($index = null, $count = null, $map = null){
		die('Not implemented');
	}

	/**
	* Retrieves a result set that contains the elements of the SQL ARRAY value designated by this Array object
	* @param Integer $index
	* @param Integer $count
	* @param Map $map

	* @return ResultSet
	*/
	function getResultSet($index = null, $count = null, $map = null){
		die('Not implemented');
	}
}
?>