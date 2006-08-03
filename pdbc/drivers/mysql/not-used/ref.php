<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: ref.php,v 1.0 2006/05/09 18:58:07
* @abstract MySQLRef
*/

require_once PDBC_INTERFACES . 'ref.php';

class MySQLRef extends Ref{
	/**
	* Retrieves the fully-qualified SQL name of the SQL structured type that this Ref object references
	* @return String
	*/
	function getBaseTypeName(){
		die('Not implemented');
	}

	/**
	* Retrieves the referenced object and maps it to a Java type using the given type map
	* @param Map $map
	* @return Object
	*/
	function &getObject($map = null){
		die('Not implemented');
	}

	/**
	* Sets the structured type value that this Ref object references to the given instance of Object
	* @param Object $value
	* @return void
	*/
	function setObject($value){
		die('Not implemented');
	}
}
?>