<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: clob.php,v 1.0 2006/05/09 18:58:07
* @abstract The mapping for the SQL CLOB type
*/

class Clob{
	/**
	* Class constructor
	* @param String $data
	*/
	function &Clob($data = ''){
		die('Not implemented');
	}

	/**
	* Retrieves the number of characters in the CLOB value designated by this Clob object
	* @return Long
	*/
	function length(){
		die('Not implemented');
	}

	/**
	* Retrieves a copy of the specified substring in the CLOB value designated by this Clob object
	* @param Long $pos
	* @param Integer $length
	* @return String
	*/
	function getSubString($pos, $length){
		die('Not implemented');
	}

	/**
	* Returns a Reader object that contains a partial Clob value, starting with the character specified by pos, which is length characters in length
	* @param Long $pos
	* @param Long $length
	* @return Reader
	*/
	function &getCharacterStream($pos = null, $length = null){
		die('Not implemented');
	}

	/**
	* Retrieves the CLOB value designated by this Clob  object as an ascii stream
	* @return InputStream
	*/
	function &getAsciiStream(){
		die('Not implemented');
	}

	/**
	* Retrieves the character position at which the specified Clob object searchstr appears in this Clob object
	* @param Long $start
	* @param Clob/String $pattern
	* @return Long
	*/
	function position(&$searchstr, $start){
		die('Not implemented');
	}

	/**
	* Writes len characters of str, starting at character offset, to the CLOB value that this Clob represents
	* @param Long $pos
	* @param String $str
	* @param Integer $offset
	* @param Integer $len
	* @return Integer
	*/
	function setString($pos, $str, $offset = null, $len = null){
		die('Not implemented');
	}

	/**
	* Retrieves a stream to be used to write Ascii characters to the CLOB value that this Clob object represents, starting at position pos
 	* @param Long $pos
	* @return OutputStream
	*/
	function &setAsciiStream($pos){
		die('Not implemented');
	}

	/**
	* Retrieves a stream to be used to write a stream of Unicode characters to the CLOB value that this Clob object represents, at position pos
 	* @param Long $pos
	* @return Writer
	*/
	function &setCharacterStream($pos){
		die('Not implemented');
	}

	/**
	* Truncates the CLOB value that this Clob designates to have a length of len characters
	* @param Long $len
	* @return void
	*/
	function truncate($len){
		die('Not implemented');
	}

	/**
	* This method frees the Clob object and releases the resources the resources that it holds
	* @return void
	*/
	function free(){
		die('Not implemented');
	}
}
?>