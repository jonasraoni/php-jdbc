<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: blob.php,v 1.0 2006/05/14 18:58:07
* @abstract MySQL BLOB
*/

require_once PDBC_INTERFACES . 'blob.php';

class MySQLBlob extends Blob{
	var $_data = array();

	/**
	* Class constructor
	* @param String/Integer[] $data
	*/
	function &MySQLBlob($data = ''){
		if(is_array($data))
			$this->_data = $data;
		else
			foreach(str_split($data) as $c)
				$this->_data[] = ord($c);
		return $this;
	}

	/**
	* Returns the number of bytes in the BLOB value designated by this Blob object
	* @return Long
	*/
	function length(){
		return count($this->_data);
	}

	/**
	* Retrieves all or part of the BLOB value that this Blob object represents, as an array of bytes
	* @param Long $pos
	* @param Long $length
	* @return Integer[]
	*/
	function getBytes($pos, $length){
		return array_slice($this->_data, $pos - 1, $length);
	}

	/**
	* Returns an InputStream object that contains a partial Blob value, starting with the byte specified by pos, which is length bytes in length
	* @param Long $pos
	* @param Long $length
	* @return InputStream
	*/
	function &getBinaryStream($pos = null, $length = null){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

	/**
	* Retrieves the byte position in the BLOB value designated by this Blob object at which pattern begins
	* @param Long $start
	* @param Blob/Integer[] $pattern
	* @return Long
	*/
	function position(&$pattern, $start){
		if(is_a($pattern, 'blob')){
			unset($pattern);
			$pattern = $pattern->getBytes(0, $pattern->length());
		}
		for(--$start, $i = count($this->data), $l = count($pattern) - 1; $i && --$i >= $l + $start;){
			for($j = $l + 1, $k = $i - $l; --$j && $this->data[$k + $j] == $pattern[$j];);
			if(!$j && $this->data[$k + $j] == $pattern[$j])
				return $i - $l + 1;
		}
		return -1;
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
		if($offset === null)
			$offset = 1;
		if($len === null)
			$len = count($bytes);
		$count = count($bytes = array_slice($bytes, $offset - 1, $len));
		$data = array_splice($this->_data, $pos - 1, $count, $bytes);
		return $count;

	}

	/**
	* Retrieves a stream that can be used to write to the BLOB value that this Blob object represents
 	* @param Long $pos
	* @return OutputStream
	*/
	function &setBinaryStream($pos){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

	/**
	* Truncates the BLOB value that this Blob object represents to be len bytes in length
	* @param Long $len
	* @return void
	*/
	function truncate($len){
		array_splice($this->_data, $len);
	}

	/**
	* This method frees the Blob object and releases the resources that it holds
	* @return void
	*/
	function free(){
		$this->_data = array();
	}
}
?>