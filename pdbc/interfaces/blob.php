<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: blob.php,v 1.0 2006/05/09 18:58:07
* @abstract The mapping of an SQL BLOB value
*/

class Blob{
	/**
	* Class constructor
	* @param String/Integer[] $data
	*/
	function &Blob($data = ''){
		die('Not implemented');
	}

	/**
	* Returns the number of bytes in the BLOB value designated by this Blob object
	* @return Long
	*/
	function length(){
		die('Not implemented');
	}

	/**
	* Retrieves all or part of the BLOB value that this Blob object represents, as an array of bytes
	* @param Long $pos
	* @param Long $length
	* @return Integer[]
	*/
	function getBytes($pos, $length){
		die('Not implemented');
	}

	/**
	* Returns an InputStream object that contains a partial Blob value, starting with the byte specified by pos, which is length bytes in length
	* @param Long $pos
	* @param Long $length
	* @return InputStream
	*/
	function &getBinaryStream($pos = null, $length = null){
		die('Not implemented');
	}

	/**
	* Retrieves the byte position in the BLOB value designated by this Blob object at which pattern begins
	* @param Long $start
	* @param Blob/Integer[] $pattern
	* @return Long
	*/
	function position(&$pattern, $start){
		die('Not implemented');
	}

	/**
	* Writes all or part of the given byte array to the BLOB value that this Blob object represents and returns the number of bytes written
	* @param Long $pos
	* @param Integer[] $bytes
	* @param Long $offset
	* @param Long $len
	* @return Integer
	*/
	function setBytes($pos, $bytes, $offset = null, $len = null){
		die('Not implemented');
	}

	/**
	* Retrieves a stream that can be used to write to the BLOB value that this Blob object represents
 	* @param Long $pos
	* @return OutputStream
	*/
	function &setBinaryStream($pos){
		die('Not implemented');
	}

	/**
	* Truncates the BLOB value that this Blob object represents to be len bytes in length
	* @param Long $len
	* @return void
	*/
	function truncate($len){
		die('Not implemented');
	}

	/**
	* This method frees the Blob object and releases the resources that it holds
	* @return void
	*/
	function free(){
		die('Not implemented');
	}
}
?>