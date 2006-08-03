<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: struct.php,v 1.0 2006/05/09 18:58:07
* @abstract The standard mapping in the Java programming language for an SQL structured type
*/

class Struct{
	/**
	* Class constructor
	* @param Array $struct
	*/
	function &Struct($struct = array()){
		die('Not implemented');
	}

	/**
	* Retrieves the SQL type name of the SQL structured type that this Struct object represents
	* @return String
	*/
	function getSQLTypeName(){
		die('Not implemented');
	}

	/**
	* Produces the ordered values of the attributes of the SQL structured type that this Struct object represents
	* @param Map $map
	* @return Object[]
	*/
	function getAttributes($map){
		die('Not implemented');
	}
}
?>