<?php
/**
* @package dao
* @subpackage classes
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-maker.php,v 1.0 2006/05/25 11:53:52
* @abstract Generates sql comands for insert/update and delete statements
*/

class SQLMaker{
	/**
	* Generates an insert statement
	* @param String $table The table name
	* @param Array $fieldset An associate array mapping fields to its values
	* return String
	*/
	function insert($table, $fieldset){
		return "INSERT INTO $table (" . implode(',', array_keys($fieldset)) . ') VALUES (' . implode(',', array_values($fieldset)) . ')';
	}

	/**
	* Generates a delete statement
	* @param String $table The table name
	* @param String $where The delete conditions
	* return String
	*/
	function delete($table, $where = ''){
		return "DELETE FROM $table" . ($where ? ' WHERE ' . $where : '');
	}

	/**
	* Generates an update statement
	* @param String $table The table name
	* @param Array $fieldset An associate array mapping fields to its values
	* @param String $where The update conditions
	* return String
	*/
	function update($table, $fieldset, $where = ''){
		foreach($fieldset as $field=>$value) $set[] = "$field=$value";
		return "UPDATE $table SET " . implode(',', $set) . ($where ? " WHERE $where" : '');
	}
}
?>