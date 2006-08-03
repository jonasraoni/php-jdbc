<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: driver.php,v 1.0 2006/05/09 17:37:50
* @abstract The interface that every driver class must implement
*/

class Driver{
	/**
	* Attempts to make a database connection to the given URL
	* @param String $url
	* @param Properties $info
	* @throw SQLException
	* @return Connection
	*/
	function &connect($url, $info){
		die('Not implemented');
	}

	/**
	* Retrieves whether the driver thinks that it can open a connection to the given URL
	* @param String $url
	* @throw SQLException
	* @return Boolean
	*/
	function acceptsURL($url){
		die('Not implemented');
	}

	/**
	* Gets information about the possible properties for this driver
	* @param String $url
	* @param Properties $info
	* @throw SQLException
	* @return DriverPropertyInfo
	*/
	function &getPropertyInfo(&$url, $info){
		die('Not implemented');
	}

	/**
	* Retrieves the driver's major version number
	* @return Integer
	*/
	function getMajorVersion(){
		die('Not implemented');
	}

	/**
	* Gets the driver's minor version number
	* @return Integer
	*/
	function getMinorVersion(){
		die('Not implemented');
	}

	/**
	* Reports whether this driver is a genuine JDBC Compliant driver
	* @return Boolean
	*/
	function pdbcCompliant(){
		die('Not implemented');
	}
}

?>