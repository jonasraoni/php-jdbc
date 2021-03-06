<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: prepared-statement.php,v 1.0 2006/05/09 18:58:07
* @abstract An object that represents a precompiled SQL statement
*/

/*PREPARE stmt1 FROM 'SELECT SQRT(POW(?,2) + POW(?,2)) AS hypotenuse';
SET @a = 3;
SET @b = 4;
EXECUTE stmt1 USING @a, @b;
DEALLOCATE PREPARE stmt2;*/


require_once PDBC_INTERFACES . 'prepared-statement.php';
require_once PDBC_MYSQL_DRIVER . 'statement.php';

class MySQLPreparedStatement extends MySQLStatement{
	var $_autoGenerateKeys = null;
	var $_statementName = 'PDBC_PREPARED_STATEMENT';
	var $_poolable = false;
	var $_params = array();

	function close(){
		if(!mysql_query('DEALLOCATE PREPARE ' . $this->_statementName))
			return PDBCException::throwIt(new SQLException($connection->_errorMsg(), '', $connection->_errorCode()));
		parent::close();
	}

	function _set($index, $value){
		$this->_params[$index] = $value;
	}

	/**
	* Class constructor
	* @param Connection $connection
	* @param String $sql
	* @param Integer $resultSetType
	* @param Integer $resultSetConcurrency
	* @param Integer $resultSetHoldability
	*/
	function &MySQLPreparedStatement(&$connection, $sql, $resultSetType, $resultSetConcurrency, $resultSetHoldability, $autoGeneratedKeysOrColumnIndexesOrNames = null){
		static $id = 0;
		if(is_int($autoGeneratedKeysOrColumnIndexesOrNames) && $autoGeneratedKeysOrColumnIndexesOrNames != RETURN_GENERATED_KEYS  && $autoGeneratedKeysOrColumnIndexesOrNames != NO_GENERATED_KEYS)
			return PDBCException::throwIt(new SQLException('Unrecognized value for the autoGenerateKeys argument'));
		parent::MySQLStatement($connection, $resultSetType, $resultSetConcurrency, $resultSetHoldability);
		if(!mysql_query('PREPARE ' . ($this->_statementName .= ++$id) . " FROM '" . mysql_real_escape_string($sql, $connection->_handle) . "'"))
			return PDBCException::throwIt(new SQLException($connection->_errorMsg(), '', $connection->_errorCode()));
		$this->_autoGenerateKeys = $autoGeneratedKeysOrColumnIndexesOrNames;
	}

	/**
	* Adds a set of parameters to this PreparedStatement object's batch of commands
	* @return void
	*/
	function addBatch(){
		$this->_paramsBatch[] = $this->_params;
	}

 	/**
	* Clears the current parameter values immediately
	* @return void
	*/
	function clearParameters(){
		$this->_params = array();
	}

	/**
	* Executes the SQL statement in this PreparedStatement object, which may be any kind of SQL statement
	* @return Boolean
	*/
	function execute($sql = null, $autoGeneratedKeysOrColumnIndexesOrNames = null){
		if($sql !== null)
			return parent::execute($sql, $autoGeneratedKeysOrColumnIndexesOrNames);
		$args = array();
		foreach(end($this->_params) as $n=>$v){
			$args[] = $name = $this->_statementName . '_' . $n;
			if(!mysql_query('SET @' . $name . ' = ' . $v))
				return PDBCException::throwIt(new SQLException($connection->_errorMsg(), '', $connection->_errorCode()));
		}
		$exec = parent::execute('EXECUTE  ' . $this->_statementName . (count($args) ? ' USING ' . implode(', ', $args) : ''), $this->_autoGenerateKeys);
		if($x = &PDBCException::catchIt('SQLException'))
			return PDBCException::throwIt($x);
		return $exec;
	}

	/**
	* Executes the SQL query in this PreparedStatement object and returns the ResultSet object generated by the query
	* @return ResultSet
	*/
	function &executeQuery($sql = null){
		if($sql !== null)
			return parent::executeQuery($sql);
		$exec = $this->execute();
		if($x = &PDBCException::catchIt('SQLException'))
			return PDBCException::throwIt($x);
		if($exec)
			return $this->getResultSet();
		PDBCException::throwIt(new SQLException('The query didn\'t returned a valid resultset'));
	}

	/**
	* Executes the SQL statement in this PreparedStatement object, which must be an SQL Data Manipulation Language (DML) statement, such as INSERT, UPDATE or DELETE; or an SQL statement that returns nothing, such as a DDL statement
	* @return Integer
	*/
	function executeUpdate($sql = null){
		if($sql !== null)
			return parent::executeQuery($sql);
		$exec = $this->execute();
		if($x = &PDBCException::catchIt('SQLException'))
			return PDBCException::throwIt($x);
		if(!$exec)
			return $this->getResultSet();
		PDBCException::throwIt(new SQLException('The query returned a resultset'));
	}

	/**
	* Retrieves a ResultSetMetaData object that contains information about the columns of the ResultSet object that will be returned when this PreparedStatement object is executed
	* @return ResultSetMetaData
	*/
	function getMetaData(){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

	/**
	* Retrieves the number, types and properties of this PreparedStatement object's parameters
	* @return ParameterMetaData
	*/
	function getParameterMetaData(){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

	/**
	* Returns the value of the statements poolable hint, indicating whether pooling of the statement is requested
	* @return Boolean
	*/
	function isPoolable(){
		return $this->_poolable;
	}

 	/**
	* Requests that a PreparedStatement be pooled or not pooled
	* @param Integer $index
	* @param Boolean $poolable
	* @return void
	*/
	function setPoolable($poolable){
		$this->_poolable = $poolable;
	}

	/**
	* Sets the designated parameter to the given java.sql.Array object
	* @param Integer $index
	* @param Array $value
	* @return void
	*/
	function setArray($index, $value){
		PDBCException::throwIt(new SQLException('Not available'));
	}

	/**
	* Sets the designated parameter to the given input stream, which will have the specified number of bytes
	* @param Integer $index
	* @param InputStream $value
	* @param Integer $length
	* @return void
	*/
	function setAsciiStream($index, $value, $length){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given java.math.BigDecimal value
	* @param Integer $index
	* @param BigDecimal $value
	* @return void
	*/
	function setBigDecimal($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given input stream, which will have the specified number of bytes
	* @param Integer $index
	* @param InputStream $value
	* @param Integer $length
	* @return void
	*/
	function setBinaryStream($index, $value, $length){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given java.sql.Blob object
	* @param Integer $index
	* @param Blob $value
	* @return void
	*/
	function setBlob($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to a InputStream object
	* @param Integer $index
	* @param InputStream $value
	* @param Long $length
	* @return void
	*/
	function setBlob($index, $value, $length){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given Java boolean value
	* @param Integer $index
	* @param Boolean $value
	* @return void
	*/
	function setBoolean($index, $value){
		$this->_set($index, $value);
	}

 	/**
	* Sets the designated parameter to the given Java byte value
	* @param Integer $index
	* @param Integer $value
	* @return void
	*/
	function setByte($index, $value){
		$this->_set($index, $value);
	}

 	/**
	* Sets the designated parameter to the given Java array of bytes
	* @param Integer $index
	* @param Integer[] $value
	* @return void
	*/
	function setBytes($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given Reader object, which is the given number of characters long
	* @param Integer $index
	* @param Reader $value
	* @param Integer $length
	* @return void
	*/
	function setCharacterStream($index, $value, $length){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given java.sql.Clob object
	* @param Integer $index
	* @param Clob $value
	* @return void
	*/
	function setClob($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to a Reader object
	* @param Integer $index
	* @param Reader $value
	* @param Long $length
	* @return void
	*/
	function setClob($index, $reader, $length){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given java.sql.Date value using the default time zone of the virtual machine that is running the application
	* @param Integer $index
	* @param Date $value
	* @return void
	*/
	function setDate($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given Java double value
	* @param Integer $index
	* @param Float $value
	* @return void
	*/
	function setDouble($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given Java float value
	* @param Integer $index
	* @param Float $value
	* @return void
	*/
	function setFloat($index, $value){
		$this->_set($index, $value);
	}

 	/**
	* Sets the designated parameter to the given Java int value
	* @param Integer $index
	* @param Integer $value
	* @return void
	*/
	function setInt($index, $value){
		$this->_set($index, $value);
	}

 	/**
	* Sets the designated parameter to the given Java long value
	* @param Integer $index
	* @param Integer $value
	* @return void
	*/
	function setLong($index, $value){
		$this->_set($index, $value);
	}

 	/**
	* Sets the designated parameter to a Reader object
	* @param Integer $index
	* @param Reader $value
	* @param Long $length
	* @return void
	*/
	function setNCharacterStream($index, $value, $length){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to a java.sql.NClob object
	* @param Integer $index
	* @param NClob $value
	* @return void
	*/
	function setNClob($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to a Reader object
	* @param Integer $index
	* @param Reader $value
	* @param Long $length
	* @return void
	*/
	function setNClob($index, $value, $length){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated paramter to the given String object
	* @param Integer $index
	* @param String $value
	* @return void
	*/
	function setNString($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to SQL NULL
	* @param Integer $index
	* @param Integer $sqlType
	* @param String $typeName
	* @return void
	*/
	function setNull($index, $sqlType = null, $typeName = null){
		$this->_set($index, null);
	}

 	/**
	* Sets the value of the designated parameter with the given object
	* @param Integer $index
	* @param Object $value
	* @param Integer $targetSqlType
	* @return void
	*/
	function setObject($index, $value, $targetSqlType){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given REF(<structured-type>) value
	* @param Integer $index
	* @param Ref $value
	* @return void
	*/
	function setRef($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given java.sql.RowId object
	* @param Integer $index
	* @param RowId $value
	* @return void
	*/
	function setRowId($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given Java short value
	* @param Integer $index
	* @param Integer $value
	* @return void
	*/
	function setShort($index, $value){
		$this->_set($index, $value);
	}

 	/**
	* Sets the designated parameter to the given java.sql.SQLXML object
	* @param Integer $index
	* @param SQLXML $value
	* @return void
	*/
	function setSQLXML($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given Java String value
	* @param Integer $index
	* @param String $value
	* @return void
	*/
	function setString($index, $value){
		$this->_set($index, $value);
	}

 	/**
	* Sets the designated parameter to the given java.sql.Time value
	* @param Integer $index
	* @param Time $value
	* @return void
	*/
	function setTime($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given java.sql.Timestamp value
	* @param Integer $index
	* @param Timestamp $value
	* @return void
	*/
	function setTimestamp($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

 	/**
	* Sets the designated parameter to the given java.net.URL value
	* @param Integer $index
	* @param URL $value
	* @return void
	*/
	function setURL($index, $value){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}
}
?>