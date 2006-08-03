<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: base-query.php,v 1.0 2006/05/09 18:58:07
* @abstract The mapping in the Java programming language for the SQL type ARRAY
*/

require_once PDBC_INTERFACES . 'base-query.php';

class MySQLBaseQuery extends BaseQuery{
	/**
	* Closes this Query Object and makes it no longer usable
	* @return void
	*/
	function close(){
		die('Not implemented');
	}

	/**
	* This method returns the status of this object, the return value determining whether the object can be used or not
	* @return Boolean
	*/
	function isClosed(){
		die('Not implemented');
	}

	/**
	* Retrieves the first warning reported by invoking methods on this Query object
	* @return SQLWarning
	*/
	function getWarnings(){
		die('Not implemented');
	}

 	/**
	* Clears all warnings reported on this Query object
	* @return void
	*/
	function clearWarnings(){
		die('Not implemented');
	}
}
?>