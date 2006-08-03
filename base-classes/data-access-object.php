<?php
require_once DAO_BASE_DIR . 'base-classes/sql-maker.php';

/**
* @package dao
* @subpackage classes
* @author Jonas Raoni Soares da Silva <http://raoni.org>
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: data-access-object.php,v 1.0 2006/05/25 11:53:52
* @abstract Responsible for basic operations over a specific table
*/

class DataAccessObject{
	var $_connection = null;
	var $_statement = null;
	var $_catalog = '';
	var $_transferObjectClass = '';

	/**
	* Class constructor
	* @param String $catalog The table name
	* @param String $transferObjectClass The TransferObject inherited class associated with this DAO
	*/
	function DataAccessObject($catalog, $transferObjectClass){
		$this->_catalog = $catalog;
		$this->_transferObjectClass = $transferObjectClass;
		if(!($this->_connection = &DAOFactory::createConnection()))
			exit('Erro ao conectar ao banco de dados');
		$this->_statement = &$this->_connection->createStatement();
	}

	/**
	* Creates a new empty TransferObject
	* @return TransferObject
	*/
	function &create(){
		$x = &new $this->_transferObjectClass;
		return $x;
	}

	/**
	* Inserts the user and returns the newly created user number
	* @param TransferObject $to
	* @return Integer The new key or -1 on error
	*/
	function insert(&$to){
		$map = array();
		foreach($to->fields() as $key){
			$f = &$to->field($key);
			$map[$f->field] = $to->SQLValue($key);
		}
		$this->_statement->execute(SQLMaker::insert($this->_catalog, $map));
		if(PDBCException::catchIt('SQLException'))
			return -1;
		return mysql_insert_id($this->_connection->_handle);
	}

	/**
	* Deletes a user using the supplied TransferObject primary key as search criteria
	* @param TransferObject $to
	* @return Boolean True on success, false on error
	*/
	function delete(&$to){
		$where = array();
		foreach($to->keys() as $key){
			$f = &$to->field($key);
			$where[] = $f->field . '=' . $to->SQLValue($key);
		}
		$this->_statement->execute(SQLMaker::delete($this->_catalog, implode(' AND ', $where)));
		if(PDBCException::catchIt('SQLException'))
			return false;
		return true;
	}

	/**
	* Updates a user using the supplied TransferObject as search criteria
	* @param TransferObject $to
	* @return Boolean True on success, false on error
	*/
	function update(&$to){
		$map = array();
		foreach($to->fields() as $key){
			$f = &$to->field($key);
			$map[$f->field] = $to->SQLValue($key);
		}
		$where = array();
		foreach($to->keys() as $key){
			$f = &$to->field($key);
			$where[] = $f->field . '=' . $to->SQLValue($key);
		}
		$this->_statement->execute(SQLMaker::update($this->_catalog, $map, implode(' AND ', $where)));
		if(PDBCException::catchIt('SQLException'))
			return false;
		return true;
	}

	/**
	* Finds a user using the supplied user values as search criteria
	* @param TransferObject $to
	* @return TransferObject Return null on error or if not found
	*/
	function &find(&$to){
		$where = array();
		foreach($to->fields() as $key){
			$f = &$to->field($key);
			if(!$f->changed)
				continue;
			$where[] = $f->field . ($f->value === null ? ' IS NULL' : ($f->type == 'string' ? ' LIKE ' : '=') . $to->SQLValue($key));
		}
		$where = implode(' AND ', $where);
		$result = &$this->_statement->executeQuery('SELECT * FROM ' . $this->_catalog . ($where ? ' WHERE ' . $where : ''));
		if(PDBCException::catchIt('SQLException'))
			return $null;
		if(!$result->next()){
			$result->close();
			return $null;
		}
		$to = &$this->create();
		foreach($to->fields() as $key){
			$f = &$to->field($key);
			$to->set($key, $result->getString($f->field));
		}
		$result->close();
		return $to;
	}

	/**
	* Searches users using the supplied TransferObject as search criteria
	* @param TransferObject $to Object used to search
	* @param Integer $max = null Maximum amount of records that should be fetched
	* @param Integer $start = null Resultset offset
	* @param Array $order = array() Each element contains a fieldname followed by "desc" or "asc", the resultset will be ordered using the array order
	* @return ResultSet Null on error
	*/
	function &selectRS(&$to, $max = null, $start = null, $order = array()){
		$where = array();
		foreach($to->fields() as $key){
			$f = &$to->field($key);
			if(!$f->changed)
				continue;
			$where[] = $f->field . ($f->type != 'string' ? '=' : ' LIKE ') . $to->SQLValue($key);
		}
		$where = implode(' AND ', $where);
		$sql = 'SELECT * FROM ' . $this->_catalog . ($where ? ' WHERE ' . $where : '');
		if(count($order))
			$sql .= ' ORDER BY ' . implode(',', $order);
		if(is_int($max))
			$sql .= ' LIMIT ' . (is_int($start) ? $start . ',' : '') . $max ;
		$result = &$this->_statement->executeQuery($sql);
		if(PDBCException::catchIt('SQLException'))
			return $null;
		return $result;
	}

	/**
	* Searches users using the supplied TransferObject as search criteria
	* @param TransferObject $to Object used to search
	* @param Integer $max = null Maximum amount of records that should be fetched
	* @param Integer $start = null Resultset offset
	* @param Array $order = array() Each element contains a fieldname followed by "desc" or "asc", the resultset will be ordered using the array order
	* @return TransferObject[] Null on error
	*/
	function &selectTO(&$to, $max = null, $start = null, $order = array()){
		if(!($result = &$this->selectRS($to, $max, $start, $order)))
			return null;
		$x = array();
		while($result->next()){
			$to = &$this->create();
			foreach($to->fields() as $key){
				$f = &$to->field($key);
				$to->set($key, $result->getString($f->field));
			}
			$x[] = &$to;
		}
		$result->close();
		return $x;
	}

	/**
	* Retrieves the record count using the supplied TransferObject as search criteria
	* @param TransferObject $to
	* @return Integer
	*/
	function getCount(&$to){
		$where = array();
		foreach($to->fields() as $key){
			$f = &$to->field($key);
			if(!$f->changed)
				continue;
			$where[] = $f->field . ($f->type != 'string' ? '=' : ' LIKE ') . $to->SQLValue($key);
		}
		$where = implode(' AND ', $where);
		$sql = 'SELECT COUNT(0) FROM ' . $this->_catalog . ($where ? ' WHERE ' . $where : '');
		$result = &$this->_statement->executeQuery($sql);
		if(PDBCException::catchIt('SQLException'))
			return $null;
		$result->next();
		$count = $result->getInt(1);
		$result->close();
		return $count;
	}
}
?>