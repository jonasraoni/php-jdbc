<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: wrapper.php,v 1.0 2006/05/09 18:58:07
* @abstract Interface for JDBC classes which provide the ability to retrieve the delegate instance when the instance in question is in fact a proxy class
*/

class Wrapper{
	/**
	* Returns true if this either implements the interface argument or is directly or indirectly a wrapper for an object that does
	* @param Interface $iface
	* @return Boolean
	*/
	function isWrapperFor($iface){
		die('Not implemented');
	}

 	/**
	* Returns an object that implements the given interface to allow access to non-standard methods, or standard methods not exposed by the proxy
	* @param Interface $iface
	* @return Object
	*/
	function unwrap($iface){
		die('Not implemented');
	}
}
?>