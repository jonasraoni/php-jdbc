<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-runtime-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract Thrown by the ease of development APIs, such as DataSet
*/

class SQLRuntimeException extends Exception{
	/**
	* Class constructor
	* @param String $message
	*/
	function SQLRuntimeException($message = ''){
		parent::__construct($message);
	}
}
?>
