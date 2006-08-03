<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: savepoint.php,v 1.0 2006/05/09 18:58:07
* @abstract The representation of a savepoint, which is a point within the current transaction that can be referenced from the Connection.rollback method
*/

class Savepoint{
	/**
	* Class constructor
	* @param String/Integer $nameOrId
	*/
	function &Savepoint($nameOrId){
		die('Not implemented');
	}

 	/**
	* Retrieves the generated ID for the savepoint that this Savepoint object represents
	* @return Integer
	*/
	function getSavepointId(){
		die('Not implemented');
	}

 	/**
	* Retrieves the name of the savepoint that this Savepoint object represents
	* @return String
	*/
	function getSavepointName(){
		die('Not implemented');
	}
}
?>