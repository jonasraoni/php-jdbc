<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-data.php,v 1.0 2006/05/09 18:58:07
* @abstract The interface used for the custom mapping of an SQL user-defined type (UDT)
*/

class SQLData{
	/**
	* Returns the fully-qualified name of the SQL user-defined type that this object represents
	* @return String
	*/
	function getSQLTypeName(){
		die('Not implemented');
	}

 	/**
	* Populates this object with data read from the database
	* @param SQLInput $stream
	* @param String $typeName
	* @return void
	*/
	function readSQL($stream, $typeName){
		die('Not implemented');
	}

	/**
	* Writes this object to the given SQL data stream, converting it back to its SQL value in the data source
	* @param SQLOutput $stream
	* @return void
	*/
	function writeSQL(&stream){
		die('Not implemented');
	}
}
?>