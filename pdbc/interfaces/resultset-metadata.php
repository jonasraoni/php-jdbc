<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: resultset-metadata.php,v 1.0 2006/05/09 18:58:07
* @abstract An object that can be used to get information about the types and properties of the columns in a ResultSet object
*/

class ResultSetMetaData{
	/**
	* Class constructor
	* @param ResultSet $resultset
	*/
	function &ResultSetMetaData(&$resultset){
		die('Not implemented');
	}

	/**
	* Gets the designated column's table's catalog name
	* @param Integer $column
	* @return String
	*/
	function getCatalogName($column){
		die('Not implemented');
	}

	/**
	* Returns the fully-qualified name of the Java class whose instances are manufactured if the method ResultSet.getObject is called to retrieve a value from the column
	* @param Integer $column
	* @return String
	*/
	function getColumnClassName($column){
		die('Not implemented');
	}

	/**
	* Returns the number of columns in this ResultSet object
	* @param Integer $column
	* @return Integer
	*/
	function getColumnCount(){
		die('Not implemented');
	}

	/**
	* Indicates the designated column's normal maximum width in characters
	* @param Integer $column
	* @return Integer
	*/
	function getColumnDisplaySize($column){
		die('Not implemented');
	}

	/**
	* Gets the designated column's suggested title for use in printouts and displays
	* @param Integer $column
	* @return String
	*/
	function getColumnLabel($column){
		die('Not implemented');
	}

	/**
	* Get the designated column's name
	* @param Integer $column
	* @return String
	*/
	function getColumnName($column){
		die('Not implemented');
	}

	/**
	* Retrieves the designated column's SQL type
	* @param Integer $column
	* @return Integer
	*/
	function getColumnType($column){
		die('Not implemented');
	}

	/**
	* Retrieves the designated column's database-specific type name
	* @param Integer $column
	* @return String
	*/
	function getColumnTypeName($column){
		die('Not implemented');
	}

	/**
	* Get the designated column's specified column size
	* @param Integer $column
	* @return Integer
	*/
	function getPrecision($column){
		die('Not implemented');
	}

	/**
	* Gets the designated column's number of digits to right of the decimal point
	* @param Integer $column
	* @return Integer
	*/
	function getScale($column){
		die('Not implemented');
	}

	/**
	* Get the designated column's table's schema
	* @param Integer $column
	* @return String
	*/
	function getSchemaName($column){
		die('Not implemented');
	}

	/**
	* Gets the designated column's table name
	* @param Integer $column
	* @return String
	*/
	function getTableName($column){
		die('Not implemented');
	}

	/**
	* Indicates whether the designated column is automatically numbered
	* @param Integer $column
	* @return Boolean
	*/
	function isAutoIncrement($column){
		die('Not implemented');
	}

	/**
	* Indicates whether a column's case matters
	* @param Integer $column
	* @return Boolean
	*/
	function isCaseSensitive($column){
		die('Not implemented');
	}

	/**
	* Indicates whether the designated column is a cash value
	* @param Integer $column
	* @return Boolean
	*/
	function isCurrency($column){
		die('Not implemented');
	}

	/**
	* Indicates whether a write on the designated column will definitely succeed
	* @param Integer $column
	* @return Boolean
	*/
	function isDefinitelyWritable($column){
		die('Not implemented');
	}

	/**
	* Indicates the nullability of values in the designated column
	* @param Integer $column
	* @return Integer
	*/
	function isNullable($column){
		die('Not implemented');
	}

	/**
	* Indicates whether the designated column is definitely not writable
	* @param Integer $column
	* @return Boolean
	*/
	function isReadOnly($column){
		die('Not implemented');
	}

	/**
	* Indicates whether the designated column can be used in a where clause
	* @param Integer $column
	* @return Boolean
	*/
	function isSearchable($column){
		die('Not implemented');
	}

	/**
	* Indicates whether values in the designated column are signed numbers
	* @param Integer $column
	* @return Boolean
	*/
	function isSigned($column){
		die('Not implemented');
	}

	/**
	* Indicates whether it is possible for a write on the designated column to succeed
	* @param Integer $column
	* @return Boolean
	*/
	function isWritable($column){
		die('Not implemented');
	}
}
?>