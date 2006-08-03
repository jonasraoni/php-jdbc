<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-xml.php,v 1.0 2006/05/09 18:58:07
* @abstract The mapping in JavaTM for the SQL XML type
*/

class SQLXML{
	/**
	* Class constructor
	* @return void
	*/
	function &SQLXML($xml = ''){
		die('Not implemented');
	}

 	/**
	* This method closes the SQLXML object and releases the resources that it held
	* @return void
	*/
	function free(){
		die('Not implemented');
	}

	/**
	* Returns a reader that will produce the events corresponding to the XML returned by the data
	* @return XMLStreamReader
	*/
	function &createXMLStreamReader(){
		die('Not implemented');
	}

 	/**
	* Returns a writer that will populate the stream with XML events
	* @return XMLStreamWriter
	*/
	function &createXMLStreamWriter(){
		die('Not implemented');
	}

	/**
	* Retrieves a string representation of the XML value designated by this SQLXML object
	* @return String
	*/
	function getString(){
		die('Not implemented');
	}

 	/**
	* Writes the given Java String to the XML value that this SQLXML object designates
	* @param String $str
	* @return Integer
	*/
	function setString($str){
		die('Not implemented');
	}

	/**
	* Denotes whether the SQLXML object is empty
	* @return Boolean
	*/
	function isEmpty(){
		die('Not implemented');
	}
}
?>