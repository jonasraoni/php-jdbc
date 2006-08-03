<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: savepoint.php,v 1.0 2006/05/09 18:58:07
* @abstract MySQLSavepoint
*/

require_once PDBC_INTERFACES . 'savepoint.php';

class MySQLSavepoint extends Savepoint{
	var $_id = null;
	var $_name = null;
	/**
	* Class constructor
	* @param String/Integer $nameOrId
	*/
	function &Savepoint($nameOrId){
		is_int($nameOrId) ? ($this->_id = $nameOrId) : ($this->_name = (string)$nameOrId);
		return $this;
	}

 	/**
	* Retrieves the generated ID for the savepoint that this Savepoint object represents
	* @return Integer
	*/
	function getSavepointId(){
		if($this->_id === null)
			PDBCException::throwIt(new SQLException('This is an named savepoint'));
		else
			return $this->_id;
	}

 	/**
	* Retrieves the name of the savepoint that this Savepoint object represents
	* @return String
	*/
	function getSavepointName(){
		if($this->_name === null)
			PDBCException::throwIt(new SQLException('This is an unnamed savepoint'));
		else
			return $this->_name;
	}
}
?>