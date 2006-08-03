<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: nclob.php,v 1.0 2006/05/14 18:58:07
* @abstract MySQLSQL NCLOB
*/

require_once PDBC_INTERFACES . 'nclob.php';

class MySQLNClob extends NClob{
	var $_data = '';

	/**
	* Class constructor
	* @param String $data
	*/
	function &MySQLNClob($data = ''){
		$this->_data = $data;
		return $this;
	}

	/**
	* Retrieves the number of characters in the NCLOB value designated by this NClob object
	* @return Long
	*/
	function length(){
		return strlen($this->_data);
	}

	/**
	* Retrieves a copy of the specified substring in the NCLOB value designated by this NClob object
	* @param Long $pos
	* @param Integer $length
	* @return String
	*/
	function getSubString($pos, $length){
		return substr($this->_data, $pos - 1, $length);
	}

	/**
	* Returns a Reader object that contains a partial NClob value, starting with the character specified by pos, which is length characters in length
	* @param Long $pos
	* @param Long $length
	* @return Reader
	*/
	function &getCharacterStream($pos = null, $length = null){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

	/**
	* Retrieves the NCLOB value designated by this NClob  object as an ascii stream
	* @return InputStream
	*/
	function &getAsciiStream(){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

	/**
	* Retrieves the character position at which the specified NClob object searchstr appears in this NClob object
	* @param Long $start
	* @param NClob/String $pattern
	* @return Long
	*/
	function position(&$searchstr, $start){
		if(is_a($searchstr, 'nclob')){
			unset($pattern);
			$pattern = $pattern->getBytes(0, $pattern->length());
		}
		$pos = strpos($this->_data, $searchstr, $start - 1);
		return is_int($pos) ? $pos + 1 : -1;
	}

	/**
	* Writes len characters of str, starting at character offset, to the NCLOB value that this NClob represents
	* @param Long $pos
	* @param String $str
	* @param Integer $offset
	* @param Integer $len
	* @return Integer
	*/
	function setString($pos, $str, $offset = null, $len = null){
		if($offset === null)
			$offset = 1;
		if($len === null)
			$len = strlen($str);
		$count = strlen($str = substr($str, $offset - 1, $len));
		$this->_data = substr($this->_data, 0, $pos - 1) . $str . substr($this->_data, $pos - 1 + $count);
		return $count;
	}

	/**
	* Retrieves a stream to be used to write Ascii characters to the NCLOB value that this NClob object represents, starting at position pos
 	* @param Long $pos
	* @return OutputStream
	*/
	function &setAsciiStream($pos){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

	/**
	* Retrieves a stream to be used to write a stream of Unicode characters to the NCLOB value that this NClob object represents, at position pos
 	* @param Long $pos
	* @return Writer
	*/
	function &setCharacterStream($pos){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

	/**
	* Truncates the NCLOB value that this NClob designates to have a length of len characters
	* @param Long $len
	* @return void
	*/
	function truncate($len){
		$this->_data = substr($this->_data, 0, $len);
	}

	/**
	* This method frees the NClob object and releases the resources the resources that it holds
	* @return void
	*/
	function free(){
		$this->_data = '';
	}
}
?>